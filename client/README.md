# Grocery List Manager Vue UI
## Common Commands
- Temporarily add Node to PATH
    - `nvs`
    - Use arrow keys to select desired version of Node
    - Press Enter

## Setup
### Dependencies
- JavaScript
    - Vue
    - Node
    - Node Version Switcher (NVS)
    - Vite
        - `npm install -D vite`
- CSS
    - Tailwind

## Debugging
- Run in terminal before running Launch Debug in VSCodium
    - `microsoft-edge --remote-debugging-port=9222 --user-data-dir=remote-debug-profile`
- Sample launch.json file configured for debugging with VSCodium, Edge Browser, the "Microsoft Edge Tools for VS Code" extension, & Linux Mint
    ```
    {
        "version": "0.2.0",
        "configurations": [
            {
                "type": "msedge",
                "request": "launch",
                "name": "Launch Debug",
                "url": "http://localhost:5173",
                "webRoot": "${workspaceFolder}",
                "port": 9222,
                "userDataDir": "remote-debug-profile",
                "runtimeExecutable": "/opt/microsoft/msedge/microsoft-edge"
            }
        ]
    }
    ```
