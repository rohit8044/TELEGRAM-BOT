import logging
import requests
import os
from datetime import datetime
from telegram import Update
from telegram.ext import ApplicationBuilder, CommandHandler, MessageHandler, ContextTypes, filters

# ---------- Config from Environment ----------
BOT_TOKEN = os.getenv("8366938124:AAGMffmDBP0mDCY9mMAiqPW2hO1BN8ay8cU")
API_URL = os.getenv("https://hgcheats.online/api/reset.php")
API_KEY = os.getenv("b12780ab9316ab28b7d6a72e65517e4935d3c5d557301654f562ea29c3eb34cd")
ADMINS = {int(x) for x in os.getenv("ADMINS", "").split(",") if x}

MAX_MEMBER_RESETS = 10
member_reset_count = {}

# ---------- Logging ----------
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# ---------- Format Messages ----------
def premium_start_message(chat_id: int) -> str:
    return (
        "────────────────\n"
        "🔒 *SUBSCRIPTION REQUIRED*\n"
        "────────────────\n\n"
        f"👤 Your Chat ID: `{chat_id}`\n\n"
        "⛔ Free Tier is Currently Disabled\n\n"
        "This bot requires a subscription:\n"
        "├ 💎 Basic: 10 resets/day\n"
        "└ ⭐ Premium: Unlimited resets\n\n"
        "📱 Available Commands\n"
        "├ /status - Check your status\n"
        "└ /help - View help\n\n"
        "💡 To Get Access:\n"
        "Contact the administrator to\n"
        "purchase a subscription plan.\n\n"
        "────────────────"
    )

def format_success(username: str, message: str, is_admin: bool, used: int) -> str:
    current_time = datetime.now().strftime("%I:%M:%S %p")
    usage = "Unlimited Access" if is_admin else f"{used}/{MAX_MEMBER_RESETS} today"

    return (
        "────────────────\n"
        "✅ *RESET SUCCESSFUL*\n"
        "────────────────\n\n"
        f"🎯 Operation Complete\n"
        f"👤 Username: `{username}`\n"
        f"⏰ Time: {current_time}\n"
        f"📩 Message: {message}\n"
        f"📊 Usage: {usage}\n\n"
        "────────────────"
    )

# ---------- API Call ----------
def call_reset_api(username: str):
    headers = {"Content-Type": "application/json", "X-API-Key": API_KEY}
    payload = {"username": username}
    try:
        resp = requests.post(API_URL, json=payload, headers=headers, timeout=15)
        return resp.json()
    except Exception as e:
        return {"message": f"API Error: {e}"}

# ---------- Handlers ----------
async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    chat_id = update.effective_chat.id
    await update.message.reply_text(premium_start_message(chat_id), parse_mode="Markdown")

async def help_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text(
        "📖 Use this bot to reset your HWID.\n"
        "Just *send your key* directly here, no command needed!",
        parse_mode="Markdown"
    )

async def status(update: Update, context: ContextTypes.DEFAULT_TYPE):
    user_id = update.effective_user.id
    used = member_reset_count.get(user_id, 0)
    is_admin = user_id in ADMINS
    usage = "Unlimited" if is_admin else f"{used}/{MAX_MEMBER_RESETS} today"
    await update.message.reply_text(
        f"👤 Your ID: `{user_id}`\n📊 Resets used: {usage}",
        parse_mode="Markdown"
    )

async def handle_message(update: Update, context: ContextTypes.DEFAULT_TYPE):
    user_id = update.effective_user.id
    username = update.message.text.strip()

    if " " in username or len(username) < 3:
        return

    is_admin = user_id in ADMINS

    if not is_admin:
        used = member_reset_count.get(user_id, 0)
        if used >= MAX_MEMBER_RESETS:
            await update.message.reply_text("⛔ Daily reset limit reached. Please try again tomorrow.")
            return
        member_reset_count[user_id] = used + 1

    data = call_reset_api(username)
    message = data.get("message", "No response from API")

    await update.message.reply_text(
        format_success(username, message, is_admin, member_reset_count.get(user_id, 0)),
        parse_mode="Markdown"
    )

# ---------- Main ----------
def main():
    if not BOT_TOKEN:
        raise ValueError("BOT_TOKEN is not set in environment variables!")

    app = ApplicationBuilder().token(BOT_TOKEN).build()
    app.add_handler(CommandHandler("start", start))
    app.add_handler(CommandHandler("help", help_command))
    app.add_handler(CommandHandler("status", status))
    app.add_handler(MessageHandler(filters.TEXT & ~filters.COMMAND, handle_message))
    app.run_polling()

if __name__ == "__main__":
    main()
