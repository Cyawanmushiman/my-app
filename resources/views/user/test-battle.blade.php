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
                background-color: #333;
                font-family: Arial, sans-serif;
                color: white;
            }

            .battle-scene {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .characters {
                display: flex;
                align-items: flex-end;
                gap: 100px;
                margin-bottom: 20px;
            }

            .character {
                width: 64px;
                height: 64px;
                position: relative;
            }

            .pixel {
                width: 8px;
                height: 8px;
                position: absolute;
            }

            /* 勇者のピクセルアート */
            #hero .pixel:nth-child(1) {
                background: #FFD700;
                top: 0;
                left: 24px;
            }

            #hero .pixel:nth-child(2) {
                background: #FFD700;
                top: 8px;
                left: 24px;
            }

            #hero .pixel:nth-child(3) {
                background: #FFA500;
                top: 16px;
                left: 24px;
            }

            #hero .pixel:nth-child(4) {
                background: #FFA500;
                top: 24px;
                left: 16px;
            }

            #hero .pixel:nth-child(5) {
                background: #FFA500;
                top: 24px;
                left: 24px;
            }

            #hero .pixel:nth-child(6) {
                background: #FFA500;
                top: 24px;
                left: 32px;
            }

            #hero .pixel:nth-child(7) {
                background: #0000FF;
                top: 32px;
                left: 24px;
            }

            #hero .pixel:nth-child(8) {
                background: #0000FF;
                top: 40px;
                left: 16px;
            }

            #hero .pixel:nth-child(9) {
                background: #0000FF;
                top: 40px;
                left: 32px;
            }

            #hero .pixel:nth-child(10) {
                background: #8B4513;
                top: 48px;
                left: 16px;
            }

            #hero .pixel:nth-child(11) {
                background: #8B4513;
                top: 48px;
                left: 32px;
            }

            #hero .pixel:nth-child(12) {
                background: #8B4513;
                top: 56px;
                left: 16px;
            }

            #hero .pixel:nth-child(13) {
                background: #8B4513;
                top: 56px;
                left: 32px;
            }

            /* モンスターのピクセルアート */
            #monster .pixel:nth-child(1) {
                background: #8B0000;
                top: 8px;
                left: 24px;
            }

            #monster .pixel:nth-child(2) {
                background: #8B0000;
                top: 16px;
                left: 16px;
            }

            #monster .pixel:nth-child(3) {
                background: #8B0000;
                top: 16px;
                left: 32px;
            }

            #monster .pixel:nth-child(4) {
                background: #FF0000;
                top: 24px;
                left: 8px;
            }

            #monster .pixel:nth-child(5) {
                background: #FF0000;
                top: 24px;
                left: 24px;
            }

            #monster .pixel:nth-child(6) {
                background: #FF0000;
                top: 24px;
                left: 40px;
            }

            #monster .pixel:nth-child(7) {
                background: #FF0000;
                top: 32px;
                left: 16px;
            }

            #monster .pixel:nth-child(8) {
                background: #FF0000;
                top: 32px;
                left: 32px;
            }

            #monster .pixel:nth-child(9) {
                background: #8B0000;
                top: 40px;
                left: 8px;
            }

            #monster .pixel:nth-child(10) {
                background: #8B0000;
                top: 40px;
                left: 24px;
            }

            #monster .pixel:nth-child(11) {
                background: #8B0000;
                top: 40px;
                left: 40px;
            }

            #monster .pixel:nth-child(12) {
                background: #8B0000;
                top: 48px;
                left: 16px;
            }

            #monster .pixel:nth-child(13) {
                background: #8B0000;
                top: 48px;
                left: 32px;
            }

            /* 剣エフェクト */
            .sword-effect {
                position: absolute;
                width: 32px;
                height: 32px;
                background: linear-gradient(45deg, transparent 45%, #fff 45%, #fff 55%, transparent 55%);
                transform: rotate(45deg);
                opacity: 0;
                transition: opacity 0.1s;
            }

            /* HPバー */
            .hp-bar {
                width: 100px;
                height: 10px;
                background-color: #555;
                margin-top: 10px;
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
            }

            /* アニメーション */
            @keyframes attack {

                0%,
                100% {
                    transform: translateX(0);
                }

                50% {
                    transform: translateX(25px);
                }
            }

            @keyframes damage {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }
            }
        </style>
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
                monster.style.animation = 'damage 0.2s ease-in-out 3';
                return new Promise(resolve => {
                    setTimeout(() => {
                        monster.style.animation = '';
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
                    // const damage = Math.floor(Math.random() * 20) + 10; // 10-30のランダムなダメージ
                    const damage = 40;
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