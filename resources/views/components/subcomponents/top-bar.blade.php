<div class="top-header">
    <div class="th-left">
        <a href="/" class="company">
            <i class="fab fa-reddit logo"></i>
            <span>reddit</span>
        </a>
        <div class="th-filter">
            <i class="fas fa-chart-line trend-line"></i>
            <span>Popular</span>
            <i class="fas fa-sort-down open-list"></i>
        </div>
    </div>
    <div class="th-mid">
        <div class="search-bar">
            <i class="fas fa-search search-glass"></i>
            <span>Search Reddit</span>
        </div>
        <div class="search-filters">
            <i class="fas fa-chart-bar search-filter-icon"></i>
            <i class="fas fa-chart-line search-filter-icon"></i>
            <i class="fas fa-archive search-filter-icon"></i>
        </div>
    </div>
    <div class="th-right">
        <?php if (!Auth::check()): ?> 
            @include('components.subcomponents.login-buttons')
        <?php else: ?>
            @include('components.subcomponents.logged-in-buttons')
        <?php endif; ?> 
    </div>
</div>