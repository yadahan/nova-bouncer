@if (Auth::user()->can('viewAny', \Silber\Bouncer\Database\Role::class) || Auth::user()->can('viewAny', \Silber\Bouncer\Database\Ability::class))
    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#B3C1D1" d="M 18.300781 3.351562 C 18.296875 3.085938 18.105469 2.859375 17.839844 2.820312 C 16.605469 2.652344 15.386719 2.355469 14.191406 1.917969 C 13.003906 1.484375 11.6875 0.875 10.269531 0.078125 C 10.089844 -0.0234375 9.921875 -0.0273438 9.742188 0.078125 C 8.332031 0.875 7.027344 1.484375 5.828125 1.917969 C 4.632812 2.355469 3.417969 2.652344 2.191406 2.820312 C 1.925781 2.859375 1.738281 3.085938 1.710938 3.351562 C 1.59375 8.382812 2.695312 12.496094 5.003906 15.695312 C 6.265625 17.441406 7.839844 18.855469 9.742188 19.933594 C 9.886719 20.042969 10.117188 20.03125 10.289062 19.933594 C 12.179688 18.835938 13.75 17.433594 15.007812 15.695312 C 17.320312 12.5 18.414062 8.382812 18.300781 3.351562 Z M 14.125 15.078125 C 13.03125 16.585938 11.664062 17.84375 10.007812 18.855469 C 8.347656 17.84375 6.972656 16.59375 5.886719 15.078125 C 3.785156 12.148438 2.757812 8.402344 2.796875 3.832031 C 3.957031 3.644531 5.101562 3.332031 6.25 2.910156 C 7.398438 2.488281 8.652344 1.910156 10.007812 1.175781 C 11.359375 1.910156 12.605469 2.488281 13.75 2.910156 C 14.898438 3.332031 16.054688 3.644531 17.214844 3.832031 C 17.253906 8.429688 16.21875 12.183594 14.125 15.078125 Z M 14.125 15.078125"/></svg></svg>
        <span class="sidebar-label">
            {{ __('Bouncer') }}
        </span>
    </h3>

    <ul class="list-reset mb-8">
        @can('viewAny', \Silber\Bouncer\Database\Role::class)
            <li class="leading-tight mb-4 ml-8 text-sm">
                <router-link :to="{
                    name: 'index',
                    params: {
                        resourceName: 'roles'
                    }
                }" class="text-white text-justify no-underline dim">
                    {{ __('Roles') }}
                </router-link>
            </li>
        @endcan

        @can('viewAny', \Silber\Bouncer\Database\Ability::class)
            <li class="leading-tight mb-4 ml-8 text-sm">
                <router-link :to="{
                    name: 'index',
                    params: {
                        resourceName: 'abilities'
                    }
                }" class="text-white text-justify no-underline dim">
                    {{ __('Abilities') }}
                </router-link>
            </li>
        @endcan
    </ul>
@endif
