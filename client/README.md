# Debugging
- Run in terminal before running Launch Debug in VS Code
    - `microsoft-edge --remote-debugging-port=9222 --user-data-dir=remote-debug-profile`
- Sample launch.json file configured for debugging with VS Code, Edge Browser, the "Microsoft Edge Tools for VS Code" extension, & Linux Mint
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
