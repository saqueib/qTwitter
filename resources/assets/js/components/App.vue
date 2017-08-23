<template>
    <div class="">
        <nav class="navbar ">
            <div class="container">
                <div class="navbar-brand">
                    <a href="/" class="navbar-item"><img src="/img/qTwitter-logo.png" alt="QTwitter" height="38">
                    </a>
                    <div data-target="navMenubd-example" class="navbar-burger burger"><span></span> <span></span> <span></span>
                    </div>
                </div>
                <div id="navMenubd-example" class="navbar-menu">
                    <div class="navbar-start"></div>
                    <div class="navbar-end"><a href="#" class="navbar-item"><span class="icon has-text-grey-light"><i class="fa fa-bell-o"></i></span></a>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a href="/documentation/overview/start/" class="navbar-link  is-active"><img :src="me.avatar" alt="" class="is-circle">
                            </a>
                            <div class="navbar-dropdown is-boxed is-right">
                                <div class="navbar-item"><strong>
                                    {{ me.name }}
                                </strong>
                                </div>

                                <router-link class="navbar-item" :to="{ name: 'profile', params: { username: me.username }}">
                                    Profile
                                </router-link>

                                <hr class="navbar-divider"> <a href="http://localhost:8000/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="navbar-item ">
                                Logout
                            </a>
                                <form id="logout-form" action="http://localhost:8000/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="c91zxFt0PHQZyqHkOIorF2iEgBtwW5qpDc3Nbc12">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="bg-light is-fullheight p-t-2">
            <transition name="content">
                <router-view>

                </router-view>
            </transition>
        </div>
        <!-- main router view outlet -->
    </div>
    <!-- end app wrap -->
</template>

<script>
    export default {
        data() {
          return {
              me: {}
          }
        },
        created() {
            axios.get('/me').then(res => this.me = res.data);
            console.log('Get the user info')
        }
    }
</script>