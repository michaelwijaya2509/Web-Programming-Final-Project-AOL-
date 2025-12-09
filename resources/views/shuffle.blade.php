@extends('layouts.app')

@section('title', 'Player Shuffler')

@push('styles')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --secondary: #64748b;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1e293b;
        --light: #f8fafc;
        --glass-bg: rgba(255, 255, 255, 0.98);
        --glass-border: rgba(255, 255, 255, 0.3);
        
        /* Team Colors */
        --team-1: #3b82f6;
        --team-2: #ef4444;
        --team-3: #10b981;
        --team-4: #f59e0b;
        --team-5: #8b5cf6;
        --team-6: #ec4899;
        --team-7: #6366f1;
        --team-8: #14b8a6;
    }

    body {
        background: linear-gradient(135deg, 
                    rgba(37, 99, 235, 0.02) 0%, 
                    rgba(29, 78, 216, 0.02) 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .shuffler-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header Section */
    .shuffler-header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 0 1rem;
    }

    .shuffler-header h1 {
        font-size: 2.75rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .shuffler-subtitle {
        font-size: 1.125rem;
        color: var(--secondary);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Stats Bar */
    .stats-bar {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin: 2rem auto;
        max-width: 800px;
    }

    .stat-item {
        text-align: center;
        min-width: 120px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--secondary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    /* Main Grid */
    .shuffler-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    @media (max-width: 992px) {
        .shuffler-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Card Design */
    .shuffler-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(37, 99, 235, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 
            0 8px 32px rgba(37, 99, 235, 0.08),
            0 4px 16px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .shuffler-card:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 12px 48px rgba(37, 99, 235, 0.12),
            0 8px 24px rgba(0, 0, 0, 0.06);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid rgba(37, 99, 235, 0.1);
    }

    .card-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-control {
        width: 100%;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        line-height: 1.5;
        color: var(--dark);
        background-color: white;
        border: 2px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    textarea.form-control {
        min-height: 200px;
        resize: vertical;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        line-height: 1.6;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    /* Button Group */
    .button-group {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-top: 2.5rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.5;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .btn:hover::after {
        opacity: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
    }

    .btn-secondary {
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-secondary:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.2);
    }

    .btn-danger {
        background: white;
        color: var(--danger);
        border: 2px solid var(--danger);
    }

    .btn-danger:hover {
        background: var(--danger);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.2);
    }

    /* Player List */
    .player-list-section {
        margin-top: 2rem;
    }

    .player-list-container {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .player-list-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(59, 130, 246, 0.05));
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .player-list-body {
        max-height: 300px;
        overflow-y: auto;
        padding: 1rem;
    }

    .player-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        margin: 0.5rem 0;
        background: white;
        border-radius: 12px;
        border: 2px solid rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
    }

    .player-item:hover {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.02);
        transform: translateX(4px);
    }

    .player-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
    }

    .player-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .player-details {
        flex: 1;
    }

    .player-name {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .player-meta {
        font-size: 0.875rem;
        color: var(--secondary);
    }

    .btn-remove {
        background: none;
        border: none;
        color: var(--danger);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        background: rgba(239, 68, 68, 0.1);
        transform: scale(1.1);
    }

    /* Options Section */
    .options-section {
        margin-top: 2rem;
    }

    .options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .option-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        border: 2px solid rgba(0, 0, 0, 0.08);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .option-item:hover {
        border-color: var(--primary);
        transform: translateY(-1px);
    }

    .option-checkbox {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        border: 2px solid var(--secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .option-checkbox.checked {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .option-label {
        font-weight: 500;
        color: var(--dark);
    }

    /* Teams Display */
    .teams-display {
        margin-top: 3rem;
    }

    .teams-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .team-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
    }

    .team-header {
        padding: 1.75rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .team-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.9;
    }

    .team-card[data-team="1"] .team-header::before { background: linear-gradient(135deg, var(--team-1), #60a5fa); }
    .team-card[data-team="2"] .team-header::before { background: linear-gradient(135deg, var(--team-2), #f87171); }
    .team-card[data-team="3"] .team-header::before { background: linear-gradient(135deg, var(--team-3), #34d399); }
    .team-card[data-team="4"] .team-header::before { background: linear-gradient(135deg, var(--team-4), #fbbf24); }
    .team-card[data-team="5"] .team-header::before { background: linear-gradient(135deg, var(--team-5), #a78bfa); }
    .team-card[data-team="6"] .team-header::before { background: linear-gradient(135deg, var(--team-6), #f472b6); }
    .team-card[data-team="7"] .team-header::before { background: linear-gradient(135deg, var(--team-7), #818cf8); }
    .team-card[data-team="8"] .team-header::before { background: linear-gradient(135deg, var(--team-8), #2dd4bf); }

    .team-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .team-subtitle {
        font-size: 0.875rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .team-body {
        padding: 1.75rem;
    }

    .team-player {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.875rem 1rem;
        margin: 0.5rem 0;
        background: rgba(0, 0, 0, 0.02);
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .team-player:hover {
        background: rgba(0, 0, 0, 0.04);
        transform: translateX(4px);
    }

    .player-number {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--team-1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        flex-shrink: 0;
    }

    .team-card[data-team="1"] .player-number { background: var(--team-1); }
    .team-card[data-team="2"] .player-number { background: var(--team-2); }
    .team-card[data-team="3"] .player-number { background: var(--team-3); }
    .team-card[data-team="4"] .player-number { background: var(--team-4); }
    .team-card[data-team="5"] .player-number { background: var(--team-5); }
    .team-card[data-team="6"] .player-number { background: var(--team-6); }
    .team-card[data-team="7"] .player-number { background: var(--team-7); }
    .team-card[data-team="8"] .player-number { background: var(--team-8); }

    .player-name {
        font-weight: 500;
        color: var(--dark);
        flex: 1;
    }

    .team-captain {
        padding: 1.25rem;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05));
        border-top: 1px solid rgba(245, 158, 11, 0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .captain-badge {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--warning), #fbbf24);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    /* Action Bar */
    .action-bar {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 3rem;
        padding: 2rem;
        background: rgba(37, 99, 235, 0.02);
        border-radius: 20px;
        border: 1px solid rgba(37, 99, 235, 0.1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: rgba(37, 99, 235, 0.1);
        margin-bottom: 1.5rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.75rem;
    }

    .empty-description {
        color: var(--secondary);
        max-width: 400px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Utility Classes */
    .text-center { text-align: center; }
    .mb-1 { margin-bottom: 0.25rem; }
    .mb-2 { margin-bottom: 0.5rem; }
    .mb-3 { margin-bottom: 1rem; }
    .mb-4 { margin-bottom: 1.5rem; }
    .mb-5 { margin-bottom: 2rem; }
    .mt-1 { margin-top: 0.25rem; }
    .mt-2 { margin-top: 0.5rem; }
    .mt-3 { margin-top: 1rem; }
    .mt-4 { margin-top: 1.5rem; }
    .mt-5 { margin-top: 2rem; }

    /* Responsive */
    @media (max-width: 768px) {
        .shuffler-wrapper {
            padding: 1rem;
        }
        
        .shuffler-header h1 {
            font-size: 2.25rem;
        }
        
        .shuffler-card {
            padding: 1.75rem;
        }
        
        .stats-bar {
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .stat-item {
            min-width: auto;
        }
        
        .teams-grid {
            grid-template-columns: 1fr;
        }
        
        .action-bar {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .shuffler-header h1 {
            font-size: 1.875rem;
        }
        
        .card-icon {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }
        
        .btn {
            padding: 0.875rem 1.5rem;
        }
    }

    /* Scrollbar Styling */
    .player-list-body::-webkit-scrollbar {
        width: 6px;
    }

    .player-list-body::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 3px;
    }

    .player-list-body::-webkit-scrollbar-thumb {
        background: rgba(37, 99, 235, 0.3);
        border-radius: 3px;
    }

    .player-list-body::-webkit-scrollbar-thumb:hover {
        background: rgba(37, 99, 235, 0.5);
    }
</style>
@endpush

@section('content')
<div class="shuffler-wrapper">
    <!-- Header -->
    <div class="shuffler-header">
        <h1>Player Shuffler</h1>
        <p class="shuffler-subtitle">
            Create perfectly balanced teams for your sports events with smart shuffling algorithm
        </p>
        
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-value" id="statPlayers">0</div>
                <div class="stat-label">Players</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="statTeams">0</div>
                <div class="stat-label">Teams</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="statAvg">0</div>
                <div class="stat-label">Avg/Team</div>
            </div>
        </div>
    </div>

    <!-- Main Content  -->
    <div class="shuffler-grid">
        <div>
            <div class="shuffler-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="bi bi-input-cursor-text"></i>
                    </div>
                    <h2 class="card-title">Player Input</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Player List</label>
                    <textarea class="form-control" 
                              id="playerInput" 
                              rows="6" 
                              placeholder="Enter player names (one per line or comma separated):"></textarea>
                    <small class="text-secondary mt-1 d-block">
                        <i class="bi bi-info-circle"></i> Separate players with new lines or commas
                    </small>
                </div>

                <div class="form-row">
                    <div>
                        <label class="form-label">Number of Teams</label>
                        <input type="number" 
                               class="form-control" 
                               id="numTeams" 
                               min="2" 
                               max="8" 
                               value="2">
                    </div>
                    <div>
                        <label class="form-label">Players per Team</label>
                        <input type="number" 
                               class="form-control" 
                               id="playersPerTeam" 
                               min="1" 
                               max="12" 
                               value="4">
                    </div>
                </div>

                <div class="button-group">
                    <button class="btn btn-primary" onclick="shufflePlayers()">
                        <i class="bi bi-shuffle"></i>
                        <span>Generate Teams</span>
                    </button>
                    <button class="btn btn-secondary" onclick="addRandomPlayers()">
                        <i class="bi bi-lightning"></i>
                        <span>Quick Fill</span>
                    </button>
                    <button class="btn btn-danger" onclick="clearPlayers()">
                        <i class="bi bi-trash"></i>
                        <span>Clear All</span>
                    </button>
                </div>
            </div>
        </div>

        <div>
            <div class="shuffler-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <h2 class="card-title">Team Results</h2>
                </div>

                <div id="teamResults" class="mb-4">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="empty-title">No Teams Generated</h3>
                        <p class="empty-description">
                            Add players and click "Generate Teams" to create balanced teams
                        </p>
                    </div>
                </div>

                <div class="player-list-section">
                    <div class="player-list-container">
                        <div class="player-list-header">
                            <h4 class="mb-0">Player Roster</h4>
                            <span class="text-secondary">
                                <span id="totalPlayers">0</span> players
                            </span>
                        </div>
                        <div class="player-list-body" id="playerList">
                        </div>
                    </div>
                </div>

                <div class="options-section">
                    <h4 class="mb-3">Options</h4>
                    <div class="options-grid">
                        <div class="option-item" onclick="toggleOption('balanceTeams')">
                            <div class="option-checkbox" id="balanceCheckbox">
                                <i class="bi bi-check"></i>
                            </div>
                            <span class="option-label">Smart Balance</span>
                        </div>
                        <div class="option-item" onclick="toggleOption('includeCaptains')">
                            <div class="option-checkbox" id="captainCheckbox">
                                <i class="bi bi-check"></i>
                            </div>
                            <span class="option-label">Team Captains</span>
                        </div>
                        <div class="option-item" onclick="toggleOption('showPositions')">
                            <div class="option-checkbox" id="positionCheckbox">
                                <i class="bi bi-check"></i>
                            </div>
                            <span class="option-label">Show Positions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Teams Display -->
    <div class="teams-display" id="teamsDisplay">
    </div>

    <!-- Action Bar (shown when teams are generated) -->
    <div class="action-bar" id="actionBar" style="display: none;">
        <button class="btn btn-primary" onclick="copyTeamsToClipboard()">
            <i class="bi bi-clipboard"></i>
            <span>Copy Teams</span>
        </button>
        <button class="btn btn-secondary" onclick="shufflePlayers()">
            <i class="bi bi-arrow-clockwise"></i>
            <span>Reshuffle</span>
        </button>
        <button class="btn btn-danger" onclick="clearTeams()">
            <i class="bi bi-x-circle"></i>
            <span>Clear Teams</span>
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Logic JavaScript tetap sama
    function getPlayerNames() {
        const input = document.getElementById('playerInput').value;
        const players = input.split(/[\n,]/)
            .map(name => name.trim())
            .filter(name => name.length > 0);
        return players;
    }

    function updatePlayerList() {
        const players = getPlayerNames();
        const playerListDiv = document.getElementById('playerList');
        const totalSpan = document.getElementById('totalPlayers');
        
        totalSpan.textContent = players.length;
        document.getElementById('statPlayers').textContent = players.length;
        
        playerListDiv.innerHTML = '';
        
        if (players.length === 0) {
            playerListDiv.innerHTML = `
                <div class="empty-state py-3">
                    <i class="bi bi-person-x"></i>
                    <p class="empty-description mb-0">No players added</p>
                </div>
            `;
            updateStats();
            return;
        }
        
        players.forEach((player, index) => {
            const playerDiv = document.createElement('div');
            playerDiv.className = 'player-item';
            playerDiv.innerHTML = `
                <div class="player-info">
                    <div class="player-avatar">
                        ${player.charAt(0).toUpperCase()}
                    </div>
                    <div class="player-details">
                        <div class="player-name">${player}</div>
                        <div class="player-meta">Player #${index + 1}</div>
                    </div>
                </div>
                <button class="btn-remove" onclick="removePlayer(${index})">
                    <i class="bi bi-x"></i>
                </button>
            `;
            playerListDiv.appendChild(playerDiv);
        });
        
        updateStats();
    }

    function removePlayer(index) {
        const players = getPlayerNames();
        players.splice(index, 1);
        document.getElementById('playerInput').value = players.join('\n');
        updatePlayerList();
    }

    function shufflePlayers() {
        const players = getPlayerNames();
        const numTeams = parseInt(document.getElementById('numTeams').value);
        const playersPerTeam = parseInt(document.getElementById('playersPerTeam').value);
        const balanceTeams = document.getElementById('balanceCheckbox').classList.contains('checked');
        
        if (players.length < 2) {
            alert('Please add at least 2 players');
            return;
        }
        
        const shuffled = [...players].sort(() => Math.random() - 0.5);
        const teams = [];
        
        for (let i = 0; i < numTeams; i++) {
            teams.push([]);
        }
        
        if (playersPerTeam > 0) {
            for (let i = 0; i < playersPerTeam * numTeams && i < shuffled.length; i++) {
                teams[i % numTeams].push(shuffled[i]);
            }
        } else {
            shuffled.forEach((player, index) => {
                teams[index % numTeams].push(player);
            });
        }
        
        displayTeams(teams);
        updatePlayerList();
    }

    function displayTeams(teams) {
        const resultsDiv = document.getElementById('teamResults');
        const teamsDisplayDiv = document.getElementById('teamsDisplay');
        const actionBar = document.getElementById('actionBar');
        
        let resultsHTML = '<div class="teams-grid">';
        
        teams.forEach((team, index) => {
            const teamNum = index + 1;
            const includeCaptains = document.getElementById('captainCheckbox').classList.contains('checked');
            const showPositions = document.getElementById('positionCheckbox').classList.contains('checked');
            
            resultsHTML += `
                <div class="team-card" data-team="${teamNum}">
                    <div class="team-header">
                        <h3 class="team-title">Team ${String.fromCharCode(65 + index)}</h3>
                        <div class="team-subtitle">${team.length} players</div>
                    </div>
                    <div class="team-body">
                        ${team.map((player, playerIndex) => `
                            <div class="team-player">
                                <div class="player-number">${playerIndex + 1}</div>
                                <div class="player-name">${player}</div>
                                ${showPositions ? `<small class="text-secondary">${getRandomPosition()}</small>` : ''}
                            </div>
                        `).join('')}
                    </div>
                    ${includeCaptains && team.length > 0 ? `
                        <div class="team-captain">
                            <div class="captain-badge">
                                <i class="bi bi-star"></i>
                            </div>
                            <div>
                                <small class="text-secondary">Team Captain</small>
                                <div class="player-name">${team[0]}</div>
                            </div>
                        </div>
                    ` : ''}
                </div>
            `;
        });
        
        resultsHTML += '</div>';
        
        resultsDiv.innerHTML = resultsHTML;
        teamsDisplayDiv.innerHTML = resultsHTML;
        actionBar.style.display = 'flex';
        
        document.getElementById('statTeams').textContent = teams.length;
        updateStats();
    }

    function getRandomPosition() {
        const positions = ['Forward', 'Midfielder', 'Defender', 'Goalkeeper', 'Center', 'Guard'];
        return positions[Math.floor(Math.random() * positions.length)];
    }

    function addRandomPlayers() {
        const randomPlayers = [
            "Budi Santoso", "Andi Wijaya", "Citra Dewi", "Dedi Pratama",
            "Eka Putri", "Fajar Nugroho", "Gita Maya", "Hendra Saputra",
            "Indra Setiawan", "Joko Susilo", "Kartika Sari", "Lukman Hakim",
            "Maya Indah", "Nina Utami", "Oki Pratama", "Putri Anggraini"
        ];
        
        document.getElementById('playerInput').value = randomPlayers.join('\n');
        updatePlayerList();
    }

    function clearPlayers() {
        if (confirm('Clear all players?')) {
            document.getElementById('playerInput').value = '';
            document.getElementById('teamResults').innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="empty-title">No Teams Generated</h3>
                    <p class="empty-description">
                        Add players and click "Generate Teams" to create balanced teams
                    </p>
                </div>
            `;
            document.getElementById('teamsDisplay').innerHTML = '';
            document.getElementById('actionBar').style.display = 'none';
            updatePlayerList();
        }
    }

    function clearTeams() {
        document.getElementById('teamResults').innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3 class="empty-title">No Teams Generated</h3>
                <p class="empty-description">
                    Add players and click "Generate Teams" to create balanced teams
                </p>
            </div>
        `;
        document.getElementById('teamsDisplay').innerHTML = '';
        document.getElementById('actionBar').style.display = 'none';
    }

    function copyTeamsToClipboard() {
        const teams = [];
        document.querySelectorAll('.team-card').forEach(card => {
            const teamName = card.querySelector('.team-title').textContent.trim();
            const players = Array.from(card.querySelectorAll('.player-name')).map(el => el.textContent.trim());
            teams.push(`${teamName}\n${players.join('\n')}`);
        });
        
        const textToCopy = teams.join('\n\n');
        navigator.clipboard.writeText(textToCopy).then(() => {
            alert('Teams copied to clipboard!');
        });
    }

    function toggleOption(optionId) {
        const checkbox = document.getElementById(optionId.replace('Teams', '') + 'Checkbox');
        checkbox.classList.toggle('checked');
    }

    function updateStats() {
        const players = getPlayerNames();
        const numTeams = parseInt(document.getElementById('numTeams').value);
        
        const avgPerTeam = players.length > 0 && numTeams > 0 ? 
            Math.ceil(players.length / numTeams) : 0;
        
        document.getElementById('statAvg').textContent = avgPerTeam;
    }

    document.getElementById('playerInput').addEventListener('input', updatePlayerList);
    document.getElementById('numTeams').addEventListener('change', updateStats);
    document.getElementById('playersPerTeam').addEventListener('change', updateStats);
    
    document.getElementById('balanceCheckbox').classList.add('checked');
    
    updatePlayerList();
    updateStats();
</script>
@endpush
@endsection