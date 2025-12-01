
        <ul class="bg-white ">
            <li class="mb-6">
                <a href="{{ route("manager.workers_page") }}">
                    <div>
                        <img src="{{ asset('images/icons/employee-icon.svg') }}" alt="">
                    </div>
                    <div style="writing-mode: vertical-rl; text-orientation: mixed;">
                        Dolgozó kezelése
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route("manager.items_page") }}">
                    <div>
                        <img src="{{ asset('images/icons/food-icon.svg') }}" alt="">
                    </div>
                    <div style="writing-mode: vertical-rl; text-orientation: mixed;">
                        Termékek rögzítése/módosítása
                    </div>
                </a>
            </li>
        </ul>
