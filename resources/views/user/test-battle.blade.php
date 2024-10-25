<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>勇者 vs モンスター バトル（HP・ダメージ表示付き）</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?fit=crop&w=1950&q=80');
                background-size: cover;
                font-family: 'Press Start 2P', cursive;
                color: white;
                overflow: hidden;
            }

            .battle-scene {
                display: flex;
                flex-direction: column;
                align-items: center;
                backdrop-filter: blur(5px) brightness(0.8);
                padding: 20px;
                border-radius: 15px;
            }

            .characters {
                display: flex;
                align-items: flex-end;
                gap: 100px;
                margin-bottom: 20px;
            }

            .character {
                width: 128px;
                height: 128px;
                position: relative;
                transform-origin: bottom;
                transition: transform 0.5s;
            }

            .character.shake {
                animation: shake 0.5s;
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }

            .pixel {
                width: 8px;
                height: 8px;
                position: absolute;
            }

            /* 剣エフェクト */
            .sword-effect {
                position: absolute;
                width: 64px;
                height: 64px;
                background: linear-gradient(45deg, transparent 45%, #fff 45%, #fff 55%, transparent 55%);
                transform: rotate(45deg);
                opacity: 0;
                transition: opacity 0.1s;
                z-index: 2;
            }

            /* 爆発エフェクト */
            .explosion-effect {
                position: absolute;
                width: 128px;
                height: 128px;
                background: radial-gradient(circle, rgba(255,69,0,1) 0%, rgba(255,140,0,1) 40%, rgba(0,0,0,0) 60%);
                opacity: 0;
                transition: opacity 0.2s;
            }

            /* HPバー */
            .hp-bar {
                width: 150px;
                height: 15px;
                background-color: #555;
                margin-top: 10px;
                border: 2px solid #fff;
            }

            .hp-bar-inner {
                height: 100%;
                background-color: #4CAF50;
                transition: width 0.3s;
            }

            /* ダメージ表示 */
            #damage-display {
                font-size: 24px;
                margin-top: 20px;
                min-height: 30px;
                text-shadow: 2px 2px 0 #000;
            }

            /* アニメーション */
            @keyframes attack {
                0%, 100% { transform: translateX(0); }
                50% { transform: translateX(25px); }
            }

            @keyframes damage {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="battle-scene">
            <div class="characters">
                <div>
                    <div id="hero" class="character">
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="sword-effect"></div>
                    </div>
                    <div class="hp-bar">
                        <div id="hero-hp" class="hp-bar-inner" style="width: 100%;"></div>
                    </div>
                </div>
                <div>
                    <div id="monster" class="character">
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="pixel"></div>
                        <div class="explosion-effect"></div>
                    </div>
                    <div class="hp-bar">
                        <div id="monster-hp" class="hp-bar-inner" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div id="damage-display"></div>
        </div>

        <script>
            const hero = document.getElementById('hero');
            const monster = document.getElementById('monster');
            const swordEffect = hero.querySelector('.sword-effect');
            const explosionEffect = monster.querySelector('.explosion-effect');
            const heroHpBar = document.getElementById('hero-hp');
            const monsterHpBar = document.getElementById('monster-hp');
            const damageDisplay = document.getElementById('damage-display');

            let heroHp = 100;
            let monsterHp = 100;

            function attack() {
                return new Promise(resolve => {
                    hero.style.animation = 'attack 0.5s ease-in-out';
                    setTimeout(() => {
                        swordEffect.style.opacity = '1';
                        swordEffect.style.left = '64px';
                        setTimeout(() => {
                            swordEffect.style.opacity = '0';
                            swordEffect.style.left = '32px';
                            hero.style.animation = '';
                            resolve();
                        }, 100);
                    }, 250);
                });
            }

            function damageEffect() {
                monster.classList.add('shake');
                explosionEffect.style.opacity = '1';
                return new Promise(resolve => {
                    setTimeout(() => {
                        monster.classList.remove('shake');
                        explosionEffect.style.opacity = '0';
                        resolve();
                    }, 600);
                });
            }

            function updateHp(character, damage) {
                if (character === 'monster') {
                    monsterHp = Math.max(0, monsterHp - damage);
                    monsterHpBar.style.width = `${monsterHp}%`;
                } else {
                    heroHp = Math.max(0, heroHp - damage);
                    heroHpBar.style.width = `${heroHp}%`;
                }
            }

            function displayDamage(damage) {
                damageDisplay.textContent = `${damage}ダメージを与えた！`;
                setTimeout(() => {
                    damageDisplay.textContent = '';
                }, 1000);
            }

            async function performAttacks() {
                for (let i = 0; i < 3; i++) {
                    await attack();
                    const damage = Math.floor(Math.random() * 20) + 20; // 20-40のランダムなダメージ
                    updateHp('monster', damage);
                    displayDamage(damage);
                    await damageEffect();
                    await new Promise(resolve => setTimeout(resolve, 500)); // 攻撃間の待機時間
                }
                if (monsterHp === 0) {
                    monster.style.opacity = '0.5'; // モンスターが倒れたことを表現
                    damageDisplay.textContent = 'モンスターを倒した！';
                } else {
                    damageDisplay.textContent = 'モンスターに勝てなかった...';
                }
            }

            // アニメーション開始
            performAttacks();
        </script>
    </body>

</html>
