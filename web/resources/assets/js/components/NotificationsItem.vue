<template>
    <li class="dropdown notifications-menu open">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">{{unreadNotifications.length}}</span>
        </a>
        <ul class="dropdown-menu" >
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" @click="markNotificationAsRead">

                    @forelse(App\Hopital::findOrFail(App\Role::find(2)->users()->where('user_id',Auth::user()->id)->first()->pivot->post_id)->unreadNotifications as $notification)
                    <li>
                        <notification-item v-for="unread in unreadNotifications" :unread="unread" :key="unread.id"></notification-item>


                        <a href="{{ url('/hopital/interventions/'.$notification->data['intervention']['id'] ) }}">
                            <i class="fa fa-user text-red"></i> {{ $notification->data['intervention']['sexe'] }} {{ $notification->data['intervention']['age'] }}ans en route
                            <span class="pull-right-container">
                                                <small class="label pull-right bg-red">  {{  $notification->data['intervention']['etat'] }}  </small>
                                                <small class="label pull-right bg-gray">  {{ $notification->data['intervention']['type']  }}  </small>
                                                </span>
                        </a>
                    </li>
                    @empty

                    <li><a href="#">Il y'a aucune notification</a></li>
                    @endforelse


                </ul>
            </li>
        </ul>
    </li>

</template>

<script>
    export default {
        props:['unread'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
