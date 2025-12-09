@extends('layouts.app')

@section('title', 'eSports Scoreboard')

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
        --glass-bg: rgba(255, 255, 255, 0.92);
        --glass-border: rgba(255, 255, 255, 0.2);
        
        --team-blue: #3b82f6;
        --team-red: #ef4444;
        --team-green: #10b981;
        --team-purple: #8b5cf6;
        
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scoreboard-container {
        background: linear-gradient(135deg, 
                    rgba(37, 99, 235, 0.05) 0%, 
                    rgba(29, 78, 216, 0.05) 100%);
        min-height: 100vh;
        padding: 2rem;
        position: relative;
        overflow-x: hidden;
    }

    .scoreboard-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary) 0%, 
            var(--primary-light) 50%, 
            var(--primary) 100%);
        background-size: 200% 100%;
        animation: shimmer-line 3s infinite linear;
    }

    @keyframes shimmer-line {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    /* Header Styling */
    .scoreboard-header {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 
            0 10px 30px rgba(37, 99, 235, 0.1),
            0 4px 12px rgba(0, 0, 0, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        position: relative;
        overflow: hidden;
    }

    .scoreboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(37, 99, 235, 0.05) 0%, transparent 40%),
            radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.03) 0%, transparent 40%);
        z-index: 0;
    }

    .scoreboard-header-content {
        position: relative;
        z-index: 1;
    }

    .text-gradient-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* Team Cards */
    .team-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2rem;
        transition: var(--transition);
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.08),
            0 4px 12px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .team-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--team-blue) 0%, 
            #60a5fa 50%, 
            var(--team-blue) 100%);
        background-size: 200% 100%;
        animation: shimmer-line 3s infinite linear;
    }

    .team-card.team-red::before {
        background: linear-gradient(90deg, 
            var(--team-red) 0%, 
            #f87171 50%, 
            var(--team-red) 100%);
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.12),
            0 8px 16px rgba(0, 0, 0, 0.05);
    }

    /* Team Header */
    .team-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .team-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
        color: white;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        border: 4px solid white;
    }

    .team-name {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: var(--transition);
        color: var(--dark);
        position: relative;
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 12px;
    }

    .team-name:hover {
        background: rgba(37, 99, 235, 0.05);
    }

    .team-tag {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        letter-spacing: 1px;
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .team-card.team-red .team-logo {
        background: linear-gradient(135deg, var(--team-red), #dc2626);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    .team-card.team-red .team-tag {
        background: linear-gradient(135deg, var(--team-red), #dc2626);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    /* Score Display */
    .score-display {
        text-align: center;
        margin: 2.5rem 0;
        position: relative;
    }

    .score-display::after {
        content: '';
        position: absolute;
        bottom: -1.5rem;
        left: 25%;
        right: 25%;
        height: 3px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            currentColor 50%, 
            transparent 100%);
        border-radius: 2px;
        opacity: 0.3;
    }

    .score-number {
        font-size: 5rem;
        font-weight: 800;
        line-height: 1;
        display: block;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .team-card.team-red .score-number {
        background: linear-gradient(135deg, var(--team-red), #dc2626);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .score-label {
        font-size: 0.875rem;
        opacity: 0.7;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--secondary);
        margin-top: 1rem;
    }

    /* Team Stats */
    .team-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-label {
        display: block;
        font-size: 0.875rem;
        opacity: 0.7;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--secondary);
    }

    .fouls-display {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .foul-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 2px solid var(--primary);
        background: transparent;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        cursor: pointer;
        font-weight: bold;
    }

    .team-card.team-red .foul-btn {
        border-color: var(--team-red);
        color: var(--team-red);
    }

    .foul-btn:hover:not(:disabled) {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .team-card.team-red .foul-btn:hover:not(:disabled) {
        background: var(--team-red);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .foul-count {
        font-size: 2rem;
        font-weight: 700;
        min-width: 40px;
        color: var(--dark);
    }

    .timeouts-display {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .timeout-count {
        font-size: 2rem;
        font-weight: 700;
        min-width: 40px;
        color: var(--dark);
    }

    .timeout-btn {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        color: white;
        font-size: 0.75rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .team-card.team-red .timeout-btn {
        background: linear-gradient(135deg, var(--team-red), #dc2626);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .timeout-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    .team-card.team-red .timeout-btn:hover:not(:disabled) {
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    .timeout-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    /* Score Buttons */
    .quick-score-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .score-btn {
        padding: 1.25rem 0.5rem;
        border-radius: 16px;
        border: none;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
    }

    .score-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        transition: var(--transition);
    }

    .score-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .score-btn:hover::before {
        opacity: 0.1;
    }

    .score-btn span {
        font-size: 1.5rem;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .score-btn small {
        font-size: 0.75rem;
        opacity: 0.7;
        position: relative;
        z-index: 1;
        margin-top: 0.25rem;
    }

    .score-1 { 
        color: var(--success);
        border-color: rgba(16, 185, 129, 0.2);
    }
    .score-1::before { background: var(--success); }

    .score-2 { 
        color: var(--warning);
        border-color: rgba(245, 158, 11, 0.2);
    }
    .score-2::before { background: var(--warning); }

    .score-3 { 
        color: var(--danger);
        border-color: rgba(239, 68, 68, 0.2);
    }
    .score-3::before { background: var(--danger); }

    .score-undo { 
        color: var(--secondary);
        border-color: rgba(100, 116, 139, 0.2);
    }
    .score-undo::before { background: var(--secondary); }

    /* Timer Card */
    .timer-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.08),
            0 4px 12px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .timer-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary) 0%, 
            var(--warning) 50%, 
            var(--primary) 100%);
        background-size: 200% 100%;
        animation: shimmer-line 3s infinite linear;
    }

    .timer-display {
        text-align: center;
        margin-bottom: 2rem;
    }

    .period-display {
        margin-bottom: 1.5rem;
    }

    .period-label {
        font-size: 0.875rem;
        opacity: 0.7;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--secondary);
    }

    .period-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--warning), #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0.5rem;
    }

    .period-total {
        font-size: 1.5rem;
        opacity: 0.5;
        color: var(--secondary);
    }

    .timer-clock {
        font-size: 5rem;
        font-weight: 800;
        font-family: 'Courier New', monospace;
        color: var(--dark);
        margin: 1.5rem 0;
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        box-shadow: 
            inset 0 2px 4px rgba(0, 0, 0, 0.02),
            0 4px 12px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
    }

    .timer-clock.timer-warning {
        color: var(--danger);
        border-color: var(--danger);
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .timer-controls {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .timer-btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition);
        min-width: 140px;
        justify-content: center;
        cursor: pointer;
        font-size: 1rem;
    }

    .timer-btn:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .btn-start {
        background: linear-gradient(135deg, var(--success), #0da674);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-pause {
        background: linear-gradient(135deg, var(--warning), #d97706);
        color: white;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-reset {
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .timer-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    /* Game Info */
    .game-info {
        display: flex;
        justify-content: center;
        gap: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: var(--secondary);
    }

    .info-item i {
        color: var(--primary);
        font-size: 1rem;
    }

    /* Roster Card */
    .roster-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.08),
            0 4px 12px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        position: relative;
        overflow: hidden;
    }

    .roster-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--success) 0%, 
            #34d399 50%, 
            var(--success) 100%);
        background-size: 200% 100%;
        animation: shimmer-line 3s infinite linear;
    }

    .roster-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .roster-header h6 {
        color: var(--dark);
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .roster-header .btn {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid var(--primary);
        color: var(--primary);
        background: transparent;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .roster-header .btn:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .roster-teams {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .roster-team h6 {
        color: var(--secondary);
        font-size: 0.875rem;
        opacity: 0.7;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .roster-team.team-a h6 {
        color: var(--team-blue);
    }

    .roster-team.team-b h6 {
        color: var(--team-red);
    }

    .player-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .player-item {
        background: white;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: var(--transition);
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .player-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        border-color: var(--primary);
    }

    .player-number {
        background: linear-gradient(135deg, var(--warning), #f59e0b);
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        min-width: 40px;
        text-align: center;
    }

    /* Game Log */
    .game-log-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.08),
            0 4px 12px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        position: relative;
        overflow: hidden;
        margin-top: 2rem;
    }

    .game-log-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--secondary) 0%, 
            #94a3b8 50%, 
            var(--secondary) 100%);
        background-size: 200% 100%;
        animation: shimmer-line 3s infinite linear;
    }

    .log-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .log-header h6 {
        color: var(--dark);
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .log-header .btn {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid var(--danger);
        color: var(--danger);
        background: transparent;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .log-header .btn:hover {
        background: var(--danger);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .log-content {
        max-height: 200px;
        overflow-y: auto;
        padding-right: 0.5rem;
    }

    .log-content::-webkit-scrollbar {
        width: 6px;
    }

    .log-content::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 3px;
    }

    .log-content::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 3px;
    }

    .log-item {
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        background: white;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    }

    .log-time {
        color: var(--secondary);
        margin-right: 0.75rem;
        font-family: 'Courier New', monospace;
        font-size: 0.8rem;
    }

    .log-info {
        color: var(--secondary);
    }

    .log-score {
        color: var(--success);
    }

    .log-foul {
        color: var(--warning);
    }

    .log-timeout {
        color: var(--primary);
    }

    /* Modal Styling */
    .modal-content.bg-dark {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
    }

    .modal-header.border-light {
        border-color: rgba(255, 255, 255, 0.2) !important;
    }

    .modal-footer.border-light {
        border-color: rgba(255, 255, 255, 0.2) !important;
    }

    .form-control.bg-dark,
    .form-select.bg-dark {
        background-color: rgba(0, 0, 0, 0.3) !important;
        border-color: rgba(255, 255, 255, 0.2);
        color: white !important;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: var(--transition);
    }

    .form-control.bg-dark:focus,
    .form-select.bg-dark:focus {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
    }

    /* Animations */
    @keyframes scoreUpdate {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .score-update {
        animation: scoreUpdate 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .timer-clock {
            font-size: 3.5rem;
            padding: 1rem;
        }
        
        .score-number {
            font-size: 4rem;
        }
        
        .roster-teams {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .timer-controls {
            flex-wrap: wrap;
        }
        
        .timer-btn {
            min-width: 120px;
        }
    }

    @media (max-width: 768px) {
        .team-stats {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .timer-controls {
            flex-direction: column;
            align-items: center;
        }
        
        .timer-btn {
            width: 100%;
            max-width: 200px;
        }
        
        .quick-score-buttons {
            grid-template-columns: 1fr;
        }
        
        .game-info {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }
        
        .score-display::after {
            left: 15%;
            right: 15%;
        }
    }

    @media (max-width: 576px) {
        .scoreboard-container {
            padding: 1rem;
        }
        
        .timer-clock {
            font-size: 2.5rem;
            padding: 0.75rem;
        }
        
        .score-number {
            font-size: 3rem;
        }
        
        .team-card {
            padding: 1.5rem;
        }
        
        .team-logo {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .team-name {
            font-size: 1.5rem;
        }
        
        .score-btn {
            padding: 1rem 0.5rem;
        }
        
        .score-btn span {
            font-size: 1.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="scoreboard-container">
    <!-- Header -->
    <div class="scoreboard-header">
        <div class="scoreboard-header-content d-flex justify-content-between align-items-center">
            <div>
                <h1 class="text-gradient-primary mb-1">Scoreboard</h1>
                <small class="text-secondary">Live Match Manager</small>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm px-3 py-2 rounded-pill d-flex align-items-center gap-2" 
                        data-bs-toggle="modal" 
                        data-bs-target="#matchSettingsModal">
                    <i class="bi bi-gear"></i> Settings
                </button>
                <button class="btn btn-primary btn-sm px-3 py-2 rounded-pill d-flex align-items-center gap-2" 
                        onclick="toggleFullscreen()">
                    <i class="bi bi-fullscreen"></i> Fullscreen
                </button>
            </div>
        </div>
    </div>

    <!-- Main Scoreboard -->
    <div class="container">
        <div class="row g-4">
            <!-- Team A -->
            <div class="col-lg-3">
                <div class="team-card team-blue">
                    <div class="team-header">
                        <div class="team-logo">
                            <i class="bi bi-controller"></i>
                        </div>
                        <h3 id="teamAName" class="team-name" onclick="editTeamName('A')">BLUE DRAGONS</h3>
                        <div class="team-tag" id="teamATag">BLUE</div>
                    </div>
                    
                    <div class="score-display">
                        <span id="scoreA" class="score-number">0</span>
                        <small class="score-label">POINTS</small>
                    </div>
                    
                    <div class="team-stats">
                        <div class="stat-item">
                            <span class="stat-label">FOULS</span>
                            <div class="fouls-display">
                                <button class="foul-btn foul-minus" onclick="updateFouls('A', -1)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span id="foulsA" class="foul-count">0</span>
                                <button class="foul-btn foul-plus" onclick="updateFouls('A', 1)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <span class="stat-label">TIMEOUTS</span>
                            <div class="timeouts-display">
                                <span id="timeoutsA" class="timeout-count">3</span>
                                <button class="timeout-btn" onclick="useTimeout('A')" id="timeoutBtnA">
                                    <i class="bi bi-hourglass"></i> USE
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="quick-score-buttons">
                        <button class="score-btn score-1" onclick="updateScore('A', 1)">
                            <span>+1</span>
                            <small>SINGLE</small>
                        </button>
                        <button class="score-btn score-2" onclick="updateScore('A', 2)">
                            <span>+2</span>
                            <small>DOUBLE</small>
                        </button>
                        <button class="score-btn score-3" onclick="updateScore('A', 3)">
                            <span>+3</span>
                            <small>TRIPLE</small>
                        </button>
                        <button class="score-btn score-undo" onclick="updateScore('A', -1)">
                            <span>UNDO</span>
                            <small>LAST POINT</small>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Center Panel -->
            <div class="col-lg-6">
                <!-- Timer Section -->
                <div class="timer-card">
                    <div class="timer-display">
                        <div class="period-display">
                            <span class="period-label">PERIOD</span>
                            <span id="period" class="period-number">1</span>
                            <span class="period-total">/4</span>
                        </div>
                        
                        <div id="timer" class="timer-clock">
                            10:00
                        </div>
                        
                        <div class="timer-controls">
                            <button class="timer-btn btn-start" onclick="startTimer()" id="startBtn">
                                <i class="bi bi-play-fill"></i>
                                <span>START</span>
                            </button>
                            <button class="timer-btn btn-pause" onclick="pauseTimer()" id="pauseBtn">
                                <i class="bi bi-pause-fill"></i>
                                <span>PAUSE</span>
                            </button>
                            <button class="timer-btn btn-reset" onclick="resetTimer()">
                                <i class="bi bi-stop-fill"></i>
                                <span>RESET</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Game Info -->
                    <div class="game-info">
                        <div class="info-item">
                            <i class="bi bi-calendar-event"></i>
                            <span id="matchDate">{{ date('d M Y') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock-history"></i>
                            <span id="matchTime">{{ date('H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-trophy"></i>
                            <span id="matchType">FRIENDLY MATCH</span>
                        </div>
                    </div>
                </div>

                <!-- Player Roster -->
                <div class="roster-card">
                    <div class="roster-header">
                        <h6><i class="bi bi-people"></i> PLAYER ROSTER</h6>
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#rosterModal">
                            <i class="bi bi-plus"></i> Add Player
                        </button>
                    </div>
                    
                    <div class="roster-teams">
                        <div class="roster-team team-a">
                            <h6>TEAM BLUE</h6>
                            <div id="teamARoster" class="player-list">
                                <div class="player-item">
                                    <span>Budi Santoso</span>
                                    <span class="player-number">#10</span>
                                </div>
                                <div class="player-item">
                                    <span>Andi Wijaya</span>
                                    <span class="player-number">#07</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="roster-team team-b">
                            <h6>TEAM RED</h6>
                            <div id="teamBRoster" class="player-list">
                                <div class="player-item">
                                    <span>Cahyo Pratama</span>
                                    <span class="player-number">#23</span>
                                </div>
                                <div class="player-item">
                                    <span>Deni Setiawan</span>
                                    <span class="player-number">#11</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team B -->
            <div class="col-lg-3">
                <div class="team-card team-red">
                    <div class="team-header">
                        <div class="team-logo">
                            <i class="bi bi-joystick"></i>
                        </div>
                        <h3 id="teamBName" class="team-name" onclick="editTeamName('B')">RED PHOENIX</h3>
                        <div class="team-tag" id="teamBTag">RED</div>
                    </div>
                    
                    <div class="score-display">
                        <span id="scoreB" class="score-number">0</span>
                        <small class="score-label">POINTS</small>
                    </div>
                    
                    <div class="team-stats">
                        <div class="stat-item">
                            <span class="stat-label">FOULS</span>
                            <div class="fouls-display">
                                <button class="foul-btn foul-minus" onclick="updateFouls('B', -1)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span id="foulsB" class="foul-count">0</span>
                                <button class="foul-btn foul-plus" onclick="updateFouls('B', 1)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <span class="stat-label">TIMEOUTS</span>
                            <div class="timeouts-display">
                                <span id="timeoutsB" class="timeout-count">3</span>
                                <button class="timeout-btn" onclick="useTimeout('B')" id="timeoutBtnB">
                                    <i class="bi bi-hourglass"></i> USE
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="quick-score-buttons">
                        <button class="score-btn score-1" onclick="updateScore('B', 1)">
                            <span>+1</span>
                            <small>SINGLE</small>
                        </button>
                        <button class="score-btn score-2" onclick="updateScore('B', 2)">
                            <span>+2</span>
                            <small>DOUBLE</small>
                        </button>
                        <button class="score-btn score-3" onclick="updateScore('B', 3)">
                            <span>+3</span>
                            <small>TRIPLE</small>
                        </button>
                        <button class="score-btn score-undo" onclick="updateScore('B', -1)">
                            <span>UNDO</span>
                            <small>LAST POINT</small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Log -->
    <div class="container mt-4">
        <div class="game-log-card">
            <div class="log-header">
                <h6><i class="bi bi-journal-text"></i> GAME LOG</h6>
                <button class="btn btn-sm btn-outline-danger" onclick="clearLog()">
                    <i class="bi bi-trash"></i> Clear Log
                </button>
            </div>
            <div id="gameLog" class="log-content">
                <div class="log-item log-info">
                    <span class="log-time">[{{ date('H:i:s') }}]</span>
                    <span>Game initialized. Ready to start!</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Match Settings Modal -->
<div class="modal fade" id="matchSettingsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-light">
            <div class="modal-header border-light">
                <h5 class="modal-title">Match Settings</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Game Type</label>
                        <select class="form-select bg-dark text-light" id="gameType">
                            <option value="friendly">Friendly Match</option>
                            <option value="tournament">Tournament</option>
                            <option value="league">League Game</option>
                            <option value="exhibition">Exhibition</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Period Duration (minutes)</label>
                        <input type="number" class="form-control bg-dark text-light" id="periodDuration" value="10" min="1" max="60">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Periods</label>
                        <input type="number" class="form-control bg-dark text-light" id="totalPeriods" value="4" min="1" max="10">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Timeouts per Team</label>
                        <input type="number" class="form-control bg-dark text-light" id="timeoutsPerTeam" value="3" min="0" max="10">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Max Fouls</label>
                        <input type="number" class="form-control bg-dark text-light" id="maxFouls" value="5" min="1" max="20">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applySettings()">Apply Settings</button>
            </div>
        </div>
    </div>
</div>

<!-- Roster Modal -->
<div class="modal fade" id="rosterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-light">
            <div class="modal-header border-light">
                <h5 class="modal-title">Add Player</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Player Name</label>
                    <input type="text" class="form-control bg-dark text-light" id="newPlayerName" placeholder="Enter player name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Player Number</label>
                    <input type="number" class="form-control bg-dark text-light" id="newPlayerNumber" placeholder="00" min="0" max="99">
                </div>
                <div class="mb-3">
                    <label class="form-label">Assign to Team</label>
                    <select class="form-select bg-dark text-light" id="newPlayerTeam">
                        <option value="A">Team Blue</option>
                        <option value="B">Team Red</option>
                        <option value="bench">Bench</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addPlayer()">Add Player</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Game State
    const gameState = {
        scoreA: 0,
        scoreB: 0,
        foulsA: 0,
        foulsB: 0,
        timeoutsA: 3,
        timeoutsB: 3,
        timer: 600, // 10 minutes in seconds
        timerInterval: null,
        isTimerRunning: false,
        period: 1,
        totalPeriods: 4,
        periodDuration: 600,
        maxFouls: 5,
        timeoutsPerTeam: 3,
        gameType: 'friendly',
        history: []
    };

    // DOM Elements
    const elements = {
        scoreA: document.getElementById('scoreA'),
        scoreB: document.getElementById('scoreB'),
        foulsA: document.getElementById('foulsA'),
        foulsB: document.getElementById('foulsB'),
        timeoutsA: document.getElementById('timeoutsA'),
        timeoutsB: document.getElementById('timeoutsB'),
        timer: document.getElementById('timer'),
        period: document.getElementById('period'),
        teamAName: document.getElementById('teamAName'),
        teamBName: document.getElementById('teamBName'),
        teamATag: document.getElementById('teamATag'),
        teamBTag: document.getElementById('teamBTag'),
        gameLog: document.getElementById('gameLog'),
        startBtn: document.getElementById('startBtn'),
        pauseBtn: document.getElementById('pauseBtn')
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        updateDisplay();
        addLog('Game initialized', 'info');
    });

    // Score Functions
    function updateScore(team, points) {
        if (team === 'A') {
            gameState.scoreA = Math.max(0, gameState.scoreA + points);
            elements.scoreA.textContent = gameState.scoreA;
            elements.scoreA.classList.add('score-update');
            setTimeout(() => elements.scoreA.classList.remove('score-update'), 300);
            
            const action = points > 0 ? `scored ${points} point(s)` : `had ${Math.abs(points)} point(s) deducted`;
            addLog(`Team Blue ${action}. Score: ${gameState.scoreA}`, 'score');
        } else {
            gameState.scoreB = Math.max(0, gameState.scoreB + points);
            elements.scoreB.textContent = gameState.scoreB;
            elements.scoreB.classList.add('score-update');
            setTimeout(() => elements.scoreB.classList.remove('score-update'), 300);
            
            const action = points > 0 ? `scored ${points} point(s)` : `had ${Math.abs(points)} point(s) deducted`;
            addLog(`Team Red ${action}. Score: ${gameState.scoreB}`, 'score');
        }
    }

    // Foul Functions
    function updateFouls(team, change) {
        if (team === 'A') {
            gameState.foulsA = Math.max(0, Math.min(gameState.maxFouls, gameState.foulsA + change));
            elements.foulsA.textContent = gameState.foulsA;
            
            if (change > 0) {
                addLog(`Team Blue committed a foul. Total: ${gameState.foulsA}/${gameState.maxFouls}`, 'foul');
                if (gameState.foulsA >= gameState.maxFouls) {
                    addLog('⚠️ Team Blue reached foul limit!', 'foul');
                }
            }
        } else {
            gameState.foulsB = Math.max(0, Math.min(gameState.maxFouls, gameState.foulsB + change));
            elements.foulsB.textContent = gameState.foulsB;
            
            if (change > 0) {
                addLog(`Team Red committed a foul. Total: ${gameState.foulsB}/${gameState.maxFouls}`, 'foul');
                if (gameState.foulsB >= gameState.maxFouls) {
                    addLog('⚠️ Team Red reached foul limit!', 'foul');
                }
            }
        }
    }

    // Timeout Functions
    function useTimeout(team) {
        if (team === 'A' && gameState.timeoutsA > 0) {
            gameState.timeoutsA--;
            elements.timeoutsA.textContent = gameState.timeoutsA;
            addLog(`Team Blue called timeout. Remaining: ${gameState.timeoutsA}`, 'timeout');
            if (gameState.isTimerRunning) pauseTimer();
        } else if (team === 'B' && gameState.timeoutsB > 0) {
            gameState.timeoutsB--;
            elements.timeoutsB.textContent = gameState.timeoutsB;
            addLog(`Team Red called timeout. Remaining: ${gameState.timeoutsB}`, 'timeout');
            if (gameState.isTimerRunning) pauseTimer();
        }
        
        updateTimeoutButtons();
    }

    function updateTimeoutButtons() {
        document.getElementById('timeoutBtnA').disabled = gameState.timeoutsA <= 0;
        document.getElementById('timeoutBtnB').disabled = gameState.timeoutsB <= 0;
    }

    // Timer Functions
    function startTimer() {
        if (!gameState.isTimerRunning) {
            gameState.isTimerRunning = true;
            gameState.timerInterval = setInterval(() => {
                if (gameState.timer > 0) {
                    gameState.timer--;
                    updateTimerDisplay();
                    
                    // Warning for last 60 seconds
                    if (gameState.timer === 60) {
                        elements.timer.classList.add('timer-warning');
                        addLog('⏰ 1 minute remaining in period', 'info');
                    }
                    
                    // Warning for last 10 seconds
                    if (gameState.timer <= 10 && gameState.timer > 0) {
                        playBeep();
                    }
                } else {
                    endPeriod();
                }
            }, 1000);
            
            elements.startBtn.disabled = true;
            elements.pauseBtn.disabled = false;
            addLog('Timer started', 'info');
        }
    }

    function pauseTimer() {
        if (gameState.isTimerRunning) {
            clearInterval(gameState.timerInterval);
            gameState.isTimerRunning = false;
            elements.startBtn.disabled = false;
            elements.pauseBtn.disabled = true;
            addLog('Timer paused', 'info');
        }
    }

    function resetTimer() {
        clearInterval(gameState.timerInterval);
        gameState.isTimerRunning = false;
        gameState.timer = gameState.periodDuration;
        gameState.period = 1;
        updateTimerDisplay();
        elements.startBtn.disabled = false;
        elements.pauseBtn.disabled = true;
        elements.timer.classList.remove('timer-warning');
        addLog('Timer reset', 'info');
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(gameState.timer / 60);
        const seconds = gameState.timer % 60;
        elements.timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function endPeriod() {
        clearInterval(gameState.timerInterval);
        gameState.isTimerRunning = false;
        
        if (gameState.period < gameState.totalPeriods) {
            gameState.period++;
            gameState.timer = gameState.periodDuration;
            elements.period.textContent = gameState.period;
            updateTimerDisplay();
            
            addLog(`🎯 Period ${gameState.period} started`, 'info');
            showNotification(`Period ${gameState.period} started!`);
            
            // Reset fouls for new period if needed
            // gameState.foulsA = 0;
            // gameState.foulsB = 0;
            // elements.foulsA.textContent = '0';
            // elements.foulsB.textContent = '0';
            
            setTimeout(startTimer, 3000);
        } else {
            endGame();
        }
        
        elements.startBtn.disabled = false;
        elements.pauseBtn.disabled = true;
        elements.timer.classList.remove('timer-warning');
    }

    function endGame() {
        addLog('🏁 GAME OVER!', 'info');
        showNotification('Game Over!');
        
        // Determine winner
        let winner = '';
        if (gameState.scoreA > gameState.scoreB) {
            winner = 'Team Blue wins!';
        } else if (gameState.scoreB > gameState.scoreA) {
            winner = 'Team Red wins!';
        } else {
            winner = 'It\'s a tie!';
        }
        
        addLog(`🏆 ${winner} Final Score: ${gameState.scoreA} - ${gameState.scoreB}`, 'info');
        showNotification(winner);
    }

    // Team Functions
    function editTeamName(team) {
        const currentName = team === 'A' ? elements.teamAName.textContent : elements.teamBName.textContent;
        const newName = prompt(`Enter new name for Team ${team}:`, currentName);
        
        if (newName && newName.trim()) {
            if (team === 'A') {
                elements.teamAName.textContent = newName.trim().toUpperCase();
                elements.teamATag.textContent = newName.trim().split(' ')[0].toUpperCase();
            } else {
                elements.teamBName.textContent = newName.trim().toUpperCase();
                elements.teamBTag.textContent = newName.trim().split(' ')[0].toUpperCase();
            }
            addLog(`Team ${team === 'A' ? 'Blue' : 'Red'} renamed to "${newName}"`, 'info');
        }
    }

    // Settings Functions
    function applySettings() {
        gameState.periodDuration = parseInt(document.getElementById('periodDuration').value) * 60;
        gameState.totalPeriods = parseInt(document.getElementById('totalPeriods').value);
        gameState.timeoutsPerTeam = parseInt(document.getElementById('timeoutsPerTeam').value);
        gameState.maxFouls = parseInt(document.getElementById('maxFouls').value);
        gameState.gameType = document.getElementById('gameType').value;
        
        // Update display
        gameState.timeoutsA = gameState.timeoutsPerTeam;
        gameState.timeoutsB = gameState.timeoutsPerTeam;
        elements.timeoutsA.textContent = gameState.timeoutsA;
        elements.timeoutsB.textContent = gameState.timeoutsB;
        
        // Update match info
        document.getElementById('matchType').textContent = 
            gameState.gameType.toUpperCase().replace('_', ' ') + ' MATCH';
        
        updateTimeoutButtons();
        addLog('Settings applied successfully', 'info');
        
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('matchSettingsModal')).hide();
    }

    // Player Functions
    function addPlayer() {
        const name = document.getElementById('newPlayerName').value.trim();
        const number = document.getElementById('newPlayerNumber').value;
        const team = document.getElementById('newPlayerTeam').value;
        
        if (!name) {
            alert('Please enter player name');
            return;
        }
        
        const playerElement = document.createElement('div');
        playerElement.className = 'player-item';
        playerElement.innerHTML = `
            <span>${name}</span>
            <span class="player-number">#${number.padStart(2, '0')}</span>
        `;
        
        if (team === 'A') {
            document.getElementById('teamARoster').appendChild(playerElement);
            addLog(`Player ${name} (#${number}) added to Team Blue`, 'info');
        } else if (team === 'B') {
            document.getElementById('teamBRoster').appendChild(playerElement);
            addLog(`Player ${name} (#${number}) added to Team Red`, 'info');
        } else {
            // Add to bench (not implemented)
        }
        
        // Clear form
        document.getElementById('newPlayerName').value = '';
        document.getElementById('newPlayerNumber').value = '';
        
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('rosterModal')).hide();
    }

    // Game Log Functions
    function addLog(message, type = 'info') {
        const now = new Date();
        const timeString = `[${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}:${now.getSeconds().toString().padStart(2, '0')}]`;
        
        const logItem = document.createElement('div');
        logItem.className = `log-item log-${type}`;
        logItem.innerHTML = `<span class="log-time">${timeString}</span> <span>${message}</span>`;
        
        elements.gameLog.appendChild(logItem);
        elements.gameLog.scrollTop = elements.gameLog.scrollHeight;
        
        // Store in history
        gameState.history.push({
            timestamp: now,
            message: message,
            type: type
        });
    }

    function clearLog() {
        if (confirm('Are you sure you want to clear the game log?')) {
            elements.gameLog.innerHTML = '';
            addLog('Game log cleared', 'info');
        }
    }

    // Utility Functions
    function updateDisplay() {
        elements.scoreA.textContent = gameState.scoreA;
        elements.scoreB.textContent = gameState.scoreB;
        elements.foulsA.textContent = gameState.foulsA;
        elements.foulsB.textContent = gameState.foulsB;
        elements.timeoutsA.textContent = gameState.timeoutsA;
        elements.timeoutsB.textContent = gameState.timeoutsB;
        elements.period.textContent = gameState.period;
        updateTimerDisplay();
        updateTimeoutButtons();
    }

    function playBeep() {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.value = 800;
            oscillator.type = 'sine';
            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.1);
        } catch (e) {
            console.log('Audio not supported');
        }
    }

    function showNotification(message) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'position-fixed top-0 end-0 m-4 p-3 rounded shadow-lg';
        notification.style.backgroundColor = 'var(--light)';
        notification.style.border = '2px solid var(--primary)';
        notification.style.zIndex = '9999';
        notification.style.minWidth = '300px';
        notification.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary text-white p-2 me-3">
                    <i class="bi bi-bell"></i>
                </div>
                <div>
                    <strong class="text-dark">Notification</strong>
                    <div class="text-secondary small">${message}</div>
                </div>
                <button class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 3000);
    }

    function toggleFullscreen() {
        const elem = document.documentElement;
        if (!document.fullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    }

    // Export game data
    function exportGameData() {
        const gameData = {
            ...gameState,
            timestamp: new Date().toISOString(),
            finalScore: `${gameState.scoreA}-${gameState.scoreB}`,
            duration: (gameState.totalPeriods * gameState.periodDuration) - gameState.timer
        };
        
        const dataStr = JSON.stringify(gameData, null, 2);
        const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
        
        const exportFileDefaultName = `game-${new Date().toISOString().slice(0,10)}.json`;
        
        const linkElement = document.createElement('a');
        linkElement.setAttribute('href', dataUri);
        linkElement.setAttribute('download', exportFileDefaultName);
        linkElement.click();
        
        addLog('Game data exported', 'info');
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // Don't trigger if typing in input
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
        
        switch(e.key) {
            case ' ':
                e.preventDefault();
                if (gameState.isTimerRunning) {
                    pauseTimer();
                } else {
                    startTimer();
                }
                break;
            case 'r':
            case 'R':
                if (e.ctrlKey) resetTimer();
                break;
            case '1':
                updateScore('A', 1);
                break;
            case '2':
                updateScore('A', 2);
                break;
            case '3':
                updateScore('A', 3);
                break;
            case '8':
                updateScore('B', 1);
                break;
            case '9':
                updateScore('B', 2);
                break;
            case '0':
                updateScore('B', 3);
                break;
            case 'Escape':
                if (document.fullscreenElement) {
                    toggleFullscreen();
                }
                break;
        }
    });
</script>
@endpush
@endsection