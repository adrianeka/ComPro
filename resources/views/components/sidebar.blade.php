<style>
    .custom-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            color: black;
            background: white;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
            justify-content: flex-start;
        }
        .custom-btn.tonal {
            background: rgba(37,151,182, 0.2);
            color: rgba(37,151,182,255);
        }
        .custom-btn .icon {
            margin-right: 8px;
        }

        .custom-btn.active {
            background: rgba(37,151,182, 0.2);
            color: rgba(37,151,182,255);
        }

</style>

@php
    $currentRoute = Route::currentRouteName();
@endphp

<div id="sidebar" class="vh-100 p-2" style="border-right: 1px solid gainsboro; background-color: white;">
    <ul class="nav flex-column mt-2">
            <li class="nav-item mb-2">
                <button class="custom-btn @if($currentRoute == 'admin.news.index') active @endif" onmouseover="this.classList.add('tonal')" 
                        onmouseleave="this.classList.remove('tonal')" 
                        onclick="window.location.href='<?= route('admin.news.index'); ?>'">
                    <div class="icon"><i class="bi bi-book"></i></div>
                    <span class="text-button">News</span>
                </button>
            </li>
            <li class="nav-item mb-2">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="custom-btn" onmouseover="this.classList.add('tonal')" 
                            onmouseleave="this.classList.remove('tonal')" 
                            type="submit">
                        <div class="icon"><i class="bi bi-box-arrow-left"></i></div>
                        <span class="text-button">Logout</span>
                    </button>
                </form>
            </li>
    </ul>
</div>
