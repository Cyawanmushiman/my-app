@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content px-5 mt-5">
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
                        
                        <!-- 勇者のピクセル -->
                        <div class="attack-effect"></div>
                        <div class="sword-effect"></div>
                    </div>
                    <div class="hp-bar">
                        <div id="hero-hp" class="hp-bar-inner" style="width: {{ $currentUserHitPointPercentage }}%;"></div>
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
                        
                        <!-- モンスターのピクセル -->
                        <div class="attack-effect"></div>
                    </div>
                    <div class="hp-bar">
                        <div id="monster-hp" class="hp-bar-inner" style="width: {{ $currentOpHitPointPercentage }}%;"></div>
                    </div>
                </div>
            </div>
            <div id="damage-display"></div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    const hero = document.getElementById('hero');
    const monster = document.getElementById('monster');
    const heroAttackEffect = hero ? hero.querySelector('.attack-effect') : null;
    const monsterAttackEffect = monster ? monster.querySelector('.attack-effect') : null;
    const heroHpBar = document.getElementById('hero-hp');
    const monsterHpBar = document.getElementById('monster-hp');
    const damageDisplay = document.getElementById('damage-display');

    let maxHeroHp = @json($maxUserHitPoint);
    let heroHp = @json($currentUserHitPoint);
    
    let maxMonsterHp = @json($maxOpHitPoint);
    let monsterHp = @json($currentOpHitPoint);

    function attack(attacker) {
        return new Promise(resolve => {
            const attackerElement = attacker === 'hero' ? hero : monster;
            const attackEffect = attacker === 'hero' ? heroAttackEffect : monsterAttackEffect;
            
            if (attackerElement) {
                attackerElement.style.animation = `${attacker}-attack 0.5s ease-in-out`;
            }
            
            setTimeout(() => {
                if (attackEffect) {
                    attackEffect.style.opacity = '1';
                    attackEffect.style.left = attacker === 'hero' ? '40px' : '-20px';
                }
                setTimeout(() => {
                    if (attackEffect) {
                        attackEffect.style.opacity = '0';
                        attackEffect.style.left = attacker === 'hero' ? '20px' : '0px';
                    }
                    if (attackerElement) {
                        attackerElement.style.animation = '';
                    }
                    resolve();
                }, 100);
            }, 250);
        });
    }

    function damageEffect(character) {
        const element = character === 'hero' ? hero : monster;
        if (element) {
            element.style.animation = 'damage 0.2s ease-in-out 3';
        }
        return new Promise(resolve => {
            setTimeout(() => {
                if (element) {
                    element.style.animation = '';
                }
                resolve();
            }, 600);
        });
    }

    function updateHp(character, damage) {
        if (character === 'monster') {
            monsterHp = Math.max(0, monsterHp - damage);
            const remainingHp = (monsterHp / maxMonsterHp) * 100;
            if (monsterHpBar) {
                monsterHpBar.style.width = `${remainingHp}%`;
            }
        } else {
            heroHp = Math.max(0, heroHp - damage);
            const remainingHp = (heroHp / maxHeroHp) * 100;
            if (heroHpBar) {
                heroHpBar.style.width = `${remainingHp}%`;
            }
        }
    }

    function displayDamage(attacker, damage) {
        if (damageDisplay) {
            damageDisplay.textContent = `${attacker === 'hero' ? '勇者' : 'モンスター'}が${damage}ダメージを与えた！`;
            setTimeout(() => {
                damageDisplay.textContent = '';
            }, 1000);
        }
    }

    async function performAttack(attacker, defender, damage) {
        await attack(attacker);
        updateHp(defender, damage);
        displayDamage(attacker, damage);
        await damageEffect(defender);
        await new Promise(resolve => setTimeout(resolve, 500)); // 攻撃間の待機時間
    }

    async function battle() {
        // 勇者の攻撃フェーズ
        const heroAttackCount = @json($latestChallengingLog->archive_count);
        for (let i = 0; i < heroAttackCount; i++) {
            if (monsterHp <= 0) break;
            await performAttack('hero', 'monster', 1);
        }

        // モンスターの攻撃フェーズ（勇者のHPが残っている場合）
        if (monsterHp > 0 && heroHp > 0) {
            const monsterDamage = @json($thisDamageToUser);
            await performAttack('monster', 'hero', monsterDamage);
        }

        // 戦闘結果の表示
        if (damageDisplay) {
            if (monsterHp <= 0) {
                if (monster) monster.style.opacity = '0.5'; // モンスターが倒れたことを表現
                damageDisplay.textContent = 'モンスターを倒した！';
            } else if (heroHp <= 0) {
                if (hero) hero.style.opacity = '0.5'; // 勇者が倒れたことを表現
                damageDisplay.textContent = '勇者は負けてしまった...';
            } else {
                damageDisplay.textContent = @json($thisDamageToOp) + 'ダメージを与え、' + @json($thisDamageToUser) + 'ダメージを受けた！';
            }
        }
    }

    // バトル開始
    battle();
</script>
@endsection