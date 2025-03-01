#!/bin/bash

# List of VS Code extensions
extensions=(
    "bmewburn.vscode-intelephense-client"
    "visualstudioexptteam.vscode"
    "visualstudioexptteam.intellicode-api-usage-examples"
    "eamodio.gitlens"
    "dineug.vuerd-vscode"
    "ms-azuretools.vscode-docker"
    "ms-vscode-remote.remote-containers"
    "bradlc.vscode-tailwindcss"
)

# Detect editor command
if command -v cursor &> /dev/null; then
    editor_cmd="cursor"
elif command -v code &> /dev/null; then
    editor_cmd="code"
elif command -v idea &> /dev/null; then
    editor_cmd="idea"
elif command -v webstorm &> /dev/null; then
    editor_cmd="webstorm"
elif command -v pycharm &> /dev/null; then
    editor_cmd="pycharm"
elif command -v phpstorm &> /dev/null; then
    editor_cmd="phpstorm"
elif command -v goland &> /dev/null; then
    editor_cmd="goland"
elif command -v subl &> /dev/null; then
    editor_cmd="subl"
elif command -v nvim &> /dev/null; then
    editor_cmd="nvim"
else
    echo "❌ No supported editor found."
    exit 1
fi

# Install extensions
for ext in "${extensions[@]}"; do
    if [[ "$editor_cmd" == "cursor" || "$editor_cmd" == "code" ]]; then
        $editor_cmd --install-extension "$ext"
    else
        echo "⚠️ Extension installation for $editor_cmd is not automated in this script."
    fi
done

echo "✅ VS Code extensions installed successfully!"
