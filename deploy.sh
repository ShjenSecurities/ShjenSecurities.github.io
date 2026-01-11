#!/bin/bash

# Clear terminal for better visibility
clear

echo "------------------------------------------------"
echo "🚀 PREPARING TO DEPLOY TO PRODUCTION"
echo "------------------------------------------------"

# 1. Ask for confirmation
read -p "Are you sure you want to merge 'development' into 'gh-pages' and push live? (y/n): " confirm

if [[ $confirm != [yY] && $confirm != [yY][eE][sS] ]]; then
    echo "❌ Deployment cancelled. Staying on development branch."
    exit 1
fi

# 2. Save any lingering changes on development
echo "💾 Saving development progress..."
git add .
# Using a slightly more descriptive auto-message
git commit -m "Site update: $(date +'%Y-%m-%d %H:%M:%S')"

# 3. Switch to the live branch
echo "🌿 Switching to gh-pages..."
git checkout gh-pages

# 4. Pull latest (Prevents conflicts if you edited on GitHub directly)
echo "📥 Pulling latest remote changes..."
git pull origin gh-pages

# 5. Merge development into gh-pages
echo "🔗 Merging development into gh-pages..."
git merge development --no-edit

# 6. Push to GitHub
echo "⬆️ Pushing to production..."
git push origin gh-pages

# 7. Return to development branch
echo "🔙 Returning to development branch..."
git checkout development

echo "------------------------------------------------"
echo "✅ DONE! Your site is now updating on GitHub."
echo "------------------------------------------------"
