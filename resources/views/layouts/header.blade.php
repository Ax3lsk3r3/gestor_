<header class="header">
    <h2 class="u-name">TRULU<b>UNICORNIO</b> 🦄
        <label for="checkbox">
            <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
        </label>
    </h2>
    <div style="display: flex; gap: 20px; align-items: center;">
        <button class="dark-mode-toggle" id="darkModeToggle" title="Cambiar tema">
            <span id="themeIcon">🌙</span>
        </button>
        <span class="notification" id="notificationBtn">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <span id="notificationNum"></span>
        </span>
    </div>
</header>
<div class="notification-bar" id="notificationBar">
    <ul id="notifications">
    
    </ul>
</div>

@push('scripts')
<script type="text/javascript">
    var openNotification = false;

    const notification = ()=> {
        let notificationBar = document.querySelector("#notificationBar");
        if (openNotification) {
            notificationBar.classList.remove('open-notification');
            openNotification = false;
        }else {
            notificationBar.classList.add('open-notification');
            openNotification = true;
        }
    }
    let notificationBtn = document.querySelector("#notificationBtn");
    notificationBtn.addEventListener("click", notification);

    $(document).ready(function(){
        $.ajax({
            url: "{{ route('notifications.count') }}",
            method: "GET",
            success: function(data) {
                if(data.count > 0) {
                    $("#notificationNum").html(data.count);
                } else {
                    $("#notificationNum").html('');
                }
            }
        });

        $.get("{{ route('notifications.list') }}", function(data) {
            $("#notifications").html(data);
        });
    });

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const themeIcon = document.getElementById('themeIcon');
    
    // Check for saved theme preference or default to light mode
    const currentTheme = localStorage.getItem('theme') || 'light';
    if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        themeIcon.textContent = '☀️';
    }
    
    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        
        // Update icon and save preference
        if (document.body.classList.contains('dark-mode')) {
            themeIcon.textContent = '☀️';
            localStorage.setItem('theme', 'dark');
        } else {
            themeIcon.textContent = '🌙';
            localStorage.setItem('theme', 'light');
        }
    });
</script>
@endpush

