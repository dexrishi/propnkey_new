<style>
:root {
    --pe-accent: #1f6b4a;
    --pe-accent-soft: #e8f5ef;
    --pe-ink: #1a1f1c;
    --pe-muted: #6b746f;
    --pe-line: #e4e8e5;
    --pe-surface: #ffffff;
    --pe-bg: #f4f6f5;
    --pe-warn: #b45309;
}

.property-edit-wizard {
    background: var(--pe-bg);
    margin: -1.5rem -1.5rem 0;
    padding: 1.5rem 1.5rem 7rem;
    min-height: calc(100vh - 60px);
}

.pe-hero {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.pe-hero-kicker {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--pe-accent);
    margin-bottom: 0.35rem;
}

.pe-hero h1 {
    font-size: 1.65rem;
    font-weight: 700;
    color: var(--pe-ink);
    margin: 0 0 0.35rem;
    line-height: 1.25;
}

.pe-hero-sub {
    color: var(--pe-muted);
    margin: 0;
    font-size: 0.95rem;
}

.pe-hero-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pe-steps {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.5rem;
    background: var(--pe-surface);
    border: 1px solid var(--pe-line);
    border-radius: 14px;
    padding: 0.75rem;
    margin-bottom: 1.25rem;
    box-shadow: 0 1px 2px rgba(26, 31, 28, 0.04);
}

.pe-step-btn {
    appearance: none;
    border: 0;
    background: transparent;
    border-radius: 10px;
    padding: 0.75rem 0.6rem;
    text-align: left;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease;
    position: relative;
    min-height: 72px;
}

.pe-step-btn:hover {
    background: var(--pe-bg);
}

.pe-step-btn.is-active {
    background: var(--pe-accent-soft);
}

.pe-step-btn.is-done .pe-step-num {
    background: var(--pe-accent);
    color: #fff;
}

.pe-step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 700;
    background: #e8ebe9;
    color: var(--pe-muted);
    margin-bottom: 0.4rem;
}

.pe-step-btn.is-active .pe-step-num {
    background: var(--pe-accent);
    color: #fff;
}

.pe-step-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 650;
    color: var(--pe-ink);
    line-height: 1.2;
}

.pe-step-hint {
    display: block;
    font-size: 0.72rem;
    color: var(--pe-muted);
    margin-top: 0.15rem;
}

.pe-progress {
    height: 4px;
    background: #e8ebe9;
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 1.25rem;
}

.pe-progress-bar {
    height: 100%;
    width: 20%;
    background: linear-gradient(90deg, var(--pe-accent), #2d9a6a);
    border-radius: 999px;
    transition: width 0.3s ease;
}

.wizard-step {
    display: none;
}

.wizard-step.is-active {
    display: block;
    animation: peFadeIn 0.28s ease;
}

@keyframes peFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.property-edit-wizard .card {
    border: 1px solid var(--pe-line);
    border-radius: 14px;
    box-shadow: 0 1px 2px rgba(26, 31, 28, 0.04);
    overflow: hidden;
}

.property-edit-wizard .card-header {
    background: #fafbfa;
    border-bottom: 1px solid var(--pe-line);
    padding: 0.9rem 1.15rem;
}

.property-edit-wizard .card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--pe-ink);
}

.property-edit-wizard .card-body {
    padding: 1.15rem;
}

.property-edit-wizard .form-label {
    font-weight: 600;
    font-size: 0.86rem;
    color: #2d342f;
}

.property-edit-wizard .form-control,
.property-edit-wizard .form-select {
    border-radius: 10px;
    border-color: #d7ddd9;
}

.property-edit-wizard .form-control:focus,
.property-edit-wizard .form-select:focus {
    border-color: var(--pe-accent);
    box-shadow: 0 0 0 0.2rem rgba(31, 107, 74, 0.15);
}

.pe-step-panel-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.pe-step-panel-title .icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: var(--pe-accent-soft);
    color: var(--pe-accent);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.pe-step-panel-title h2 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--pe-ink);
}

.pe-step-panel-title p {
    margin: 0.15rem 0 0;
    color: var(--pe-muted);
    font-size: 0.88rem;
}

.pe-sidebar {
    position: sticky;
    top: 1rem;
}

.pe-sidebar .card {
    margin-bottom: 1rem;
}

.pe-sidebar-status {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-top: 0.75rem;
}

.pe-nav {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1040;
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(10px);
    border-top: 1px solid var(--pe-line);
    padding: 0.85rem 1.25rem;
    box-shadow: 0 -8px 24px rgba(26, 31, 28, 0.06);
}

.pe-nav-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.pe-nav-meta {
    color: var(--pe-muted);
    font-size: 0.9rem;
}

.pe-nav-meta strong {
    color: var(--pe-ink);
}

.pe-nav-actions {
    display: flex;
    gap: 0.6rem;
    flex-wrap: wrap;
}

.pe-btn {
    border-radius: 10px;
    font-weight: 600;
    padding: 0.55rem 1.1rem;
}

.pe-btn-primary {
    background: var(--pe-accent);
    border-color: var(--pe-accent);
}

.pe-btn-primary:hover {
    background: #185539;
    border-color: #185539;
}

.pe-media-step {
    display: none;
}

.pe-media-step.is-active {
    display: block;
    animation: peFadeIn 0.28s ease;
}

.pe-choice-group {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
}

.pe-choice {
    position: relative;
    margin: 0;
    cursor: pointer;
}

.pe-choice input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.pe-choice span {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    min-height: 42px;
    padding: 0.55rem 1rem;
    border: 1.5px solid #d7ddd9;
    border-radius: 12px;
    background: #fff;
    color: #2d342f;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.18s ease;
}

.pe-choice span i {
    color: var(--pe-muted);
    font-size: 1rem;
}

.pe-choice:hover span {
    border-color: #b8c4bc;
    background: #f7faf8;
}

.pe-choice input:checked + span {
    border-color: var(--pe-accent);
    background: var(--pe-accent-soft);
    color: var(--pe-accent);
    box-shadow: 0 0 0 3px rgba(31, 107, 74, 0.12);
}

.pe-choice input:checked + span i {
    color: var(--pe-accent);
}

.pe-chip-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
}

.pe-chip {
    position: relative;
    margin: 0;
    cursor: pointer;
}

.pe-chip input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.pe-chip span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 72px;
    min-height: 38px;
    padding: 0.45rem 0.85rem;
    border-radius: 999px;
    border: 1.5px solid #d7ddd9;
    background: #fff;
    color: #3a433e;
    font-size: 0.86rem;
    font-weight: 600;
    transition: all 0.18s ease;
}

.pe-chip:hover span {
    border-color: #b8c4bc;
}

.pe-chip input:checked + span {
    border-color: var(--pe-accent);
    background: var(--pe-accent);
    color: #fff;
}

.pe-chip-readonly {
    display: inline-flex;
    align-items: center;
    min-height: 34px;
    padding: 0.35rem 0.8rem;
    border-radius: 999px;
    background: var(--pe-accent-soft);
    color: var(--pe-accent);
    font-size: 0.85rem;
    font-weight: 600;
}

@media (max-width: 991px) {
    .pe-steps {
        grid-template-columns: 1fr 1fr;
    }
    .pe-step-hint {
        display: none;
    }
    .property-edit-wizard {
        margin: -1rem -1rem 0;
        padding: 1rem 1rem 7.5rem;
    }
}

@media (max-width: 575px) {
    .pe-steps {
        grid-template-columns: 1fr;
    }
}
</style>
