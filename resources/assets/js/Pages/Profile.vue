<template>
    <div class="container">
        <div class="columns">
            <div class="column is-3">
                <profile-card :user="$parent.me"></profile-card>
                <!-- end profile card -->
            </div>
            <!--end sidebar-->

            <div class="column is-6">
                <div class="card">
                    <div class="card-content bg-light">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-32x32 is-circle">
                                    <img :src="$parent.me.avatar" alt="Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <form action="">
                                    <div class="field">
                                        <div class="control">
                                            <textarea rows="3" class="textarea" placeholder="Whats happening?"></textarea>
                                        </div>
                                    </div>

                                    <div class="level">
                                        <div class="level-left">
                                            <a class="has-text-grey-light">
                                                    <span class="icon">
                                                      <i class="fa fa-image"></i>
                                                    </span>
                                            </a>
                                        </div>
                                        <div class="level-right">
                                            <div class="level-item">200</div>
                                            <div class="level-item"><button class="button is-outlined is-primary">
                                                Tweet
                                            </button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--tweeter end-->
                    </div>

                    <div class="card-content tweets">
                        <article class="media tweet" v-for="n in 10">
                            <figure class="media-left">
                                <p class="image is-64x64 is-circle">
                                    <a href="">
                                        <img src="http://bulma.io/images/placeholders/128x128.png">
                                    </a>
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                                        <br>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
                                    </p>
                                </div>
                                <nav class="level is-mobile">
                                    <div class="level-left">
                                        <a class="level-item has-text-grey-light">
                                            <span class="icon is-small"><i class="fa fa-comment-o"></i></span> <small> 4</small>
                                        </a>
                                        <a class="level-item has-text-grey-light">
                                            <span class="icon is-small"><i class="fa fa-reply"></i></span> <small> 12</small>
                                        </a>
                                        <a class="level-item has-text-grey-light">
                                            <span class="icon is-small"><i class="fa fa-retweet"></i></span> <small> 34</small>
                                        </a>
                                        <a class="level-item has-text-grey-light">
                                            <span class="icon is-small"><i class="fa fa-heart"></i></span> <small> 676</small>
                                        </a>
                                    </div>
                                </nav>
                            </div>
                            <div class="media-right">
                                <button class="delete"></button>
                            </div>
                        </article>
                    </div>
                </div>
                <button class="button is-fullwidth is-large is-loading">
                    Load more...
                </button>
            </div>
            <!--end main content area-->

            <div class="column is-3">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Who to follow
                        </p>
                    </header>
                    <div class="card-content">
                        <article class="media" v-for="n in 3">
                            <figure class="media-left">
                                <p class="image is-64x64 is-circle">
                                    <img src="http://bulma.io/images/placeholders/128x128.png">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>John Smith</strong> <small>@johnsmith</small>
                                    </p>
                                    <a href="" class="button is-small">Follow</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="card m-t-2">
                    <div class="card-content">
                        <p>A demo SPA on <strong>Vue.js</strong> running <strong>GraphQL</strong> as backend implemented on <strong>Laravel</strong></p>

                        <p class="has-text-grey-light m-t-1">
                            <small>&copy; QTwitter 2017, by <a href="http://www.qcode.in" target="_blank">QCode.in</a></small>
                        </p>
                    </div>
                </div>
            </div>
            <!--end right sidebar-->
        </div>
    </div>
</template>

<script>
    import ProfileCard from "../components/ProfileCard";

    export default {
        name: 'Profile',
        components: {ProfileCard},
        data() {
            return {

            }
        },
        created() {
          console.log('Profile Component created.')
        },
        methods: {

        }
    }
</script>