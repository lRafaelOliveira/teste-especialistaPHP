<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Grupo Viamais</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #000;
            font-family: monospace;
        }

        canvas {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .error-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            border: 1px solid #00FF00;
            border-radius: 5px;
            padding: 20px;
            color: #00FF00;
            font-family: monospace;
            width: 80%;
            max-width: 800px;
            max-height: 80vh;
            overflow: auto;
            z-index: 2;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
        }

        .error-title {
            font-size: clamp(18px, 5vw, 24px);
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 1px solid #00FF00;
            padding-bottom: 10px;
        }

        .error-code {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: clamp(14px, 4vw, 18px);
            background-color: #00FF00;
            color: #000;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .error-details {
            margin-bottom: 15px;
            font-size: clamp(12px, 3vw, 16px);
            word-break: break-word;
        }

        .error-label {
            font-weight: bold;
            margin-right: 10px;
            display: inline-block;
        }

        .error-trace {
            font-size: clamp(10px, 2.5vw, 12px);
            white-space: pre-wrap;
            background-color: rgba(0, 50, 0, 0.5);
            padding: 10px;
            border-radius: 3px;
            max-height: 30vh;
            overflow-y: auto;
            word-break: break-word;
        }

        .error-btn-back {
            display: flex;
            flex-direction: column;
            text-align: center;
            margin-top: 10px;
        }

        .error-btn-back a {
            font-size: clamp(1rem, 3vw, 2rem);
            color: #00FF00;
            text-decoration: none;
        }

        /* Media queries for better responsiveness */
        @media (max-width: 768px) {
            .error-container {
                padding: 15px;
                width: 90%;
                max-width: none;
                max-height: 80vh;
            }

            .error-details {
                margin-bottom: 10px;
            }

            .error-label {
                display: block;
                margin-bottom: 5px;
            }

            .error-btn-back a {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .error-container {
                padding: 10px;
                width: 95%;
                max-height: 85vh;
            }

            .error-btn-back a {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <main>
        <canvas id="matrix"></canvas>
        <div class="error-container">
            <div class="error-code"><?= $errorCode ?></div>
            <div class="error-title">Exception Detected</div>

            <div class="error-details">
                <span class="error-label">Message:</span>
                <span><?= $errorMessage ?></span>
            </div>

            <div class="error-details">
                <span class="error-label">File:</span>
                <span><?= $file ?></span>
            </div>

            <div class="error-details">
                <span class="error-label">Line:</span>
                <span><?= $line ?></span>
            </div>

            <div class="error-details">
                <span class="error-label">Stack Trace:</span>
                <div class="error-trace"><?= $trace ?></div>
            </div>
            <div class="error-btn-back">
                <span>Tire um print dessa tela e abra um chamado (notifique a esquipe responsavel)</span>
                <a href="javascript:history.back()">Voltar</a>
            </div>
        </div>
    </main>

    <script>
        // Get the canvas element
        const canvas = document.getElementById('matrix');
        const ctx = canvas.getContext('2d');

        // Set canvas size to window size
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Characters to display (simplified as requested)
        const chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Responsive column settings
        const getColumnSettings = () => {
            // Adjust font size based on screen width
            const screenWidth = window.innerWidth;
            let fontSize, columnSpacing;

            if (screenWidth <= 480) {
                fontSize = 16;
                columnSpacing = 25;
            } else if (screenWidth <= 768) {
                fontSize = 20;
                columnSpacing = 30;
            } else {
                fontSize = 26;
                columnSpacing = 40;
            }

            return {
                fontSize,
                columnSpacing
            };
        };

        let {
            fontSize,
            columnSpacing
        } = getColumnSettings();
        let columns = Math.floor(canvas.width / columnSpacing);

        // Initialize arrays for each column
        const drops = [];
        const characters = []; // Store fixed characters for each column
        const directions = []; // 1 for down, -1 for up
        const speeds = []; // Different speeds for each column

        // Initialize columns
        const initializeColumns = (startIdx = 0, endIdx = columns) => {
            for (let i = startIdx; i < endIdx; i++) {
                drops[i] = Math.random() * canvas.height;
                directions[i] = Math.random() < 0.7 ? 1 : -1;
                speeds[i] = 3 + Math.random() * 4;
                characters[i] = [];
                const verticalSpacing = Math.floor(fontSize * 2.3);
                const columnLength = Math.ceil(canvas.height / verticalSpacing) + 1;
                for (let j = 0; j < columnLength; j++) {
                    characters[i].push(chars.charAt(Math.floor(Math.random() * chars.length)));
                }
            }
        };

        // Initial column setup
        initializeColumns();

        // Draw function
        function draw() {
            ctx.fillStyle = 'rgba(0, 0, 0, 1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < columns; i++) {
                ctx.font = `bold ${fontSize}px monospace`;
                let y = drops[i];
                const verticalSpacing = Math.floor(fontSize * 2.3);
                const columnLength = Math.ceil(canvas.height / verticalSpacing) + 1;

                for (let j = 0; j < columnLength && j < characters[i].length; j++) {
                    const charY = (y + j * verticalSpacing) % canvas.height;
                    ctx.fillStyle = j === 0 ? '#00FF00' : `rgb(0, ${Math.max(50, 200 - j * 25)}, 0)`;
                    const x = i * columnSpacing;
                    ctx.fillText(characters[i][j], x, charY);
                }

                drops[i] += directions[i] * speeds[i];

                if (directions[i] > 0 && drops[i] > canvas.height) {
                    drops[i] = 0;
                } else if (directions[i] < 0 && drops[i] < 0) {
                    drops[i] = canvas.height;
                }

                if (Math.random() < 0.001) {
                    directions[i] *= -1;
                }

                if (Math.random() < 0.003) {
                    speeds[i] = 3 + Math.random() * 4;
                }
            }
        }

        // Handle window resize with debounce
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                const oldColumns = columns;
                ({
                    fontSize,
                    columnSpacing
                } = getColumnSettings());
                columns = Math.floor(canvas.width / columnSpacing);

                if (columns > oldColumns) {
                    initializeColumns(oldColumns, columns);
                }
            }, 250);
        });

        setInterval(draw, 30);
    </script>
</body>

</html>