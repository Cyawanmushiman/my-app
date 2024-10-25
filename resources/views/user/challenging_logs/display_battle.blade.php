@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content px-5">
        <div class="battle-scene bg-black p-4">
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
            <div id="damage-display" style="height: 100px"></div>
        </div>
        
        <div class="row mb-2">
            <div class="col-12 mt-1">
                <h2 class="text-center">Achieved <span class="text-danger">{{ $consecutiveDays }}</span> consecutive
                    days</h2>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12 mt-3 text-center">
                <a href="https://calendar.google.com/calendar/u/0/r/week" class="text-decoration-none"><i class="bi bi-calendar-date me-2"></i>Let's make plans for tomorrow!</a>
            </div>
        </div>

        @for ($i = 0; $i < $dailyScores->count(); $i++)
            @if ($dailyScores[$i]->score >= 80)
            <i class="fa-solid fa-fire-flame-curved text-danger"></i>
            @elseif ($dailyScores[$i]->score >= 60)
            <i class="fa-solid fa-fire-flame-curved text-warning"></i>
            @elseif ($dailyScores[$i]->score >= 40)
            <i class="fa-solid fa-fire-flame-curved text-info"></i>
            @elseif ($dailyScores[$i]->score >= 20)
            <i class="fa-solid fa-fire-flame-curved text-primary"></i>
            @else
            <i class="fa-solid fa-fire-flame-curved text-secondary"></i>
            @endif
        @endfor

        <div class="text-center my-4">
            @if ($challenging->result_status === App\Models\Challenging::FIGHTING)
                <a class="btn btn-primary text-white" href="{{ route('user.home') }}" id="HOME">
                    <i class="fa-solid fa-house me-2"></i>HOME
                </a>
            @elseif ($challenging->result_status === App\Models\Challenging::WIN)
                <a class="btn btn-info text-white" href="{{ route('user.challengings.display_win', $challenging) }}">
                    <i class="fa-regular fa-gem me-2"></i>GET REWARD
                </a>
            @elseif ($challenging->result_status === App\Models\Challenging::LOSE)
                <a class="btn btn-danger text-white" href="{{ route('user.challengings.display_lose', $challenging) }}">
                    <i class="fa-solid fa-skull me-2"></i>CONTINUE...
                </a>
            @endif
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