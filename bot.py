import logging
import aiohttp
from telegram import Update
from telegram.ext import ApplicationBuilder, CommandHandler, ContextTypes

# ---------- Config ----------
TELEGRAM_BOT_TOKEN = "8366938124:AAGMffmDBP0mDCY9mMAiqPW2hO1BN8ay8cU"
HG_API_KEY = "b12780ab9316ab28b7d6a72e65517e4935d3c5d557301654f562ea29c3eb34cd"  # put your HG API key here if needed
HG_API_BASE = "https://hgcheats.online/api/reset.php"

# ---------- Logging ----------
logging.basicConfig(level=logging.DEBUG)  # DEBUG to see all logs
logger = logging.getLogger(__name__)

# ---------- Helper: call reset API ----------
async def call_reset_api(username: str) -> dict:
    headers = {
        "Content-Type": "application/json",
        "X-API-Key": HG_API_KEY or ""
    }
    payload = {"username": username}

    async with aiohttp.ClientSession() as session:
        try:
            async with session.post(HG_API_BASE, json=payload, headers=headers, timeout=15) as resp:
                status = resp.status
                text = await resp.text()
                logger.debug(f"API raw response [{status}]: {text}")  # 👈 Debug log
                try:
                    data = await resp.json()
                except Exception:
                    data = {"raw": text}
                return {"ok": status == 200, "status": status, "data": data}
        except Exception as e:
            logger.exception("Error calling reset API")
            return {"ok": False, "status": None, "data": {"error": str(e)}}

# ---------- Telegram handler ----------
async def reset_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    if not context.args:
        await update.message.reply_text("Usage: /reset <username>")
        return
    username = context.args[0].strip()

    await update.message.reply_text(f"🔄 Resetting `{username}`...", parse_mode="Markdown")

    result = await call_reset_api(username)

    if result["ok"]:
        await update.message.reply_text(
            f"✅ Success for `{username}`\nResponse: `{result['data']}`",
            parse_mode="Markdown"
        )
    else:
        await update.message.reply_text(
            f"❌ Failed for `{username}`\nStatus: {result['status']}\nDetails: `{result['data']}`",
            parse_mode="Markdown"
        )

# ---------- Main ----------
def main():
    app = ApplicationBuilder().token(TELEGRAM_BOT_TOKEN).build()
    app.add_handler(CommandHandler("reset", reset_command))

    logger.info("🤖 Bot starting... Press Ctrl+C to stop")
    app.run_polling()   # 👈 NO async/await here

if __name__ == "__main__":
    main()
