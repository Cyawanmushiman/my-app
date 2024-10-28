<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .controls {
            margin-bottom: 20px;
        }

        .bubble-input {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 10px;
        }

        .bubble-input label {
            font-weight: bold;
        }

        .bubble-input textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            min-height: 50px;
            font-size: 14px;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        button.remove-btn {
            background-color: #f44336;
        }

        .svg-container {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            background: white;
        }

        .bubble-text {
            font-family: Arial, sans-serif;
            font-size: 12px;
            word-wrap: break-word;
        }

        .bubble-section {
            margin-bottom: 5px;
        }

        /* セパレーターのスタイルを更新 */
        .separator {
            background-color: #eee; /* 好みの色に変更可能 */
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="controls">
            <button id="addBubble">吹き出しを追加</button>
            <span id="bubbleCount">吹き出し数: 1/8</span>
        </div>
        <div id="bubblesContainer"></div>
        <div class="svg-container">
            <svg id="mainSvg" viewBox="0 0 500 500" width="100%" height="500">
                <!-- 背景 -->
                <rect width="500" height="500" fill="#ffffff"/>
                
                <!-- キャラクター画像 -->
                <image x="175" y="175" width="150" height="150" xlink:href="{{ asset('images/pose_genki03_man.png') }}"/>
            </svg>
        </div>
    </div>

    <script>
        class BubbleManager {
            constructor() {
                this.bubbles = []; // 吹き出しの情報を格納

                // 吹き出しの新しい位置を計算
                this.positions = [
                    { // 左上
                        x: 10, y: 35,
                        connect: { x1: 160, y1: 160, x2: 175, y2: 175 }
                    },
                    { // 上
                        x: 160, y: 20,
                        connect: { x1: 250, y1: 170, x2: 250, y2: 175 }
                    },
                    { // 右上
                        x: 310, y: 35,
                        connect: { x1: 340, y1: 160, x2: 325, y2: 175 }
                    },
                    { // 右
                        x: 370, y: 160,
                        connect: { x1: 330, y1: 250, x2: 325, y2: 250 }
                    },
                    { // 右下
                        x: 310, y: 310,
                        connect: { x1: 340, y1: 340, x2: 325, y2: 325 }
                    },
                    { // 下
                        x: 160, y: 350,
                        connect: { x1: 250, y1: 330, x2: 250, y2: 325 }
                    },
                    { // 左下
                        x: 10, y: 310,
                        connect: { x1: 160, y1: 340, x2: 175, y2: 325 }
                    },
                    { // 左
                        x: -50, y: 160,
                        connect: { x1: 170, y1: 250, x2: 175, y2: 250 }
                    }
                ];

                this.usedPositions = Array(8).fill(false); // 使用中の位置を管理
                this.bubbleCounter = 0; // ユニークなIDを生成
                this.init();
            }

            init() {
                this.addBubbleBtn = document.getElementById('addBubble');
                this.bubbleCount = document.getElementById('bubbleCount');
                this.bubblesContainer = document.getElementById('bubblesContainer');
                this.svg = document.getElementById('mainSvg');

                this.addBubbleBtn.addEventListener('click', () => this.addBubble());
                this.addBubble(); // 最初の吹き出しを追加
            }

            addBubble() {
                const positionIndex = this.usedPositions.findIndex(used => !used);
                if (positionIndex === -1) return; // 位置が利用できない場合

                const position = this.positions[positionIndex];
                const id = `bubble_${this.bubbleCounter++}`;

                // テキストエリアを追加
                const inputDiv = document.createElement('div');
                inputDiv.className = 'bubble-input';
                inputDiv.innerHTML = `
                    <label>吹き出し ${this.bubbles.length + 1}</label>
                    <textarea id="current_${id}" placeholder="現在の自分">現在の自分 ${this.bubbles.length + 1}</textarea>
                    <textarea id="ideal_${id}" placeholder="理想の自分">理想の自分 ${this.bubbles.length + 1}</textarea>
                    ${this.bubbles.length > 0 ? `<button class="remove-btn" data-id="${id}">削除</button>` : ''}
                `;
                this.bubblesContainer.appendChild(inputDiv);

                // SVGの吹き出しを追加
                const bubbleGroup = document.createElementNS("http://www.w3.org/2000/svg", "g");
                bubbleGroup.id = id;
                bubbleGroup.innerHTML = `
                    <rect x="${position.x}" y="${position.y}" width="180" height="130" rx="4" fill="white" stroke="black"/>
                    <line x1="${position.connect.x1}" y1="${position.connect.y1}" 
                          x2="${position.connect.x2}" y2="${position.connect.y2}" stroke="black"/>
                    <foreignObject x="${position.x + 5}" y="${position.y + 5}" width="170" height="120">
                        <div xmlns="http://www.w3.org/1999/xhtml" class="bubble-text" id="text_content_${id}">
                            <div class="bubble-section">
                                <div id="current_text_${id}">現在の自分 ${this.bubbles.length + 1}</div>
                            </div>
                            <div class="separator">↓</div>
                            <div class="bubble-section">
                                <div id="ideal_text_${id}">理想の自分 ${this.bubbles.length + 1}</div>
                            </div>
                        </div>
                    </foreignObject>
                `;
                this.svg.appendChild(bubbleGroup);

                // イベントリスナーを設定
                const currentTextarea = document.getElementById(`current_${id}`);
                const idealTextarea = document.getElementById(`ideal_${id}`);
                const currentTextDiv = document.getElementById(`current_text_${id}`);
                const idealTextDiv = document.getElementById(`ideal_text_${id}`);

                currentTextarea.addEventListener('input', (e) => {
                    const sanitizedText = e.target.value.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, '<br>');
                    currentTextDiv.innerHTML = sanitizedText;
                });

                idealTextarea.addEventListener('input', (e) => {
                    const sanitizedText = e.target.value.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, '<br>');
                    idealTextDiv.innerHTML = sanitizedText;
                });

                if (this.bubbles.length > 0) {
                    const removeBtn = inputDiv.querySelector('.remove-btn');
                    removeBtn.addEventListener('click', () => this.removeBubble(id));
                }

                // 吹き出し情報を保存
                this.bubbles.push({ id, positionIndex });
                this.usedPositions[positionIndex] = true;

                this.updateUI();
            }

            removeBubble(id) {
                const index = this.bubbles.findIndex(bubble => bubble.id === id);
                if (index > -1) {
                    const bubble = this.bubbles[index];
                    // 位置を解放
                    this.usedPositions[bubble.positionIndex] = false;

                    // SVGの吹き出しを削除
                    const bubbleElement = document.getElementById(id);
                    bubbleElement.remove();

                    // テキストエリアを削除
                    const inputElement = document.getElementById(`current_${id}`).parentNode;
                    inputElement.remove();

                    // 吹き出し情報を削除
                    this.bubbles.splice(index, 1);

                    this.updateUI();
                }
            }

            updateUI() {
                this.bubbleCount.textContent = `吹き出し数: ${this.bubbles.length}/8`;
                this.addBubbleBtn.disabled = this.bubbles.length >= 8;
            }
        }

        // 初期化
        document.addEventListener('DOMContentLoaded', () => {
            new BubbleManager();
        });
    </script>
</body>
</html>
