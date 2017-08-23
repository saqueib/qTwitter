@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold" style="background: url('../img/cover-placeholder.jpg')">
        <div class="hero-body">
            <div class="container">
            </div>
        </div>
    </section>

    <section class="sub-nav">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    <img class="is-circle profile-pic" src="/img/avatar-placeholder.svg" alt="Image">
                </div>

                <div class="column is-6">
                    <div class="tabs">
                        <ul>
                            <li class="is-active">
                                <a><strong>Tweets</strong>
                                    <br>
                                    <small>6767</small>
                                </a>
                            </li>
                            <li>
                                <a><strong>Followers</strong>
                                    <br>
                                    <small>7367</small>
                                </a>
                            </li>
                            <li>
                                <a><strong>Following</strong>
                                    <br>
                                    <small>677</small>
                                </a>
                            </li>
                            <li>
                                <a><strong>Likes</strong>
                                    <br>
                                    <small>67</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="column is-3 has-text-right">
                    <a href="" class="button">Edit Profile</a>
                </div>

            </div>
        </div>
    </section>
    <div class="bg-light is-fullheight">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    <div class="profile-info m-t-1">
                        <p class="title is-4">John Smith</p>
                        <p class="subtitle is-6 has-text-grey-light">@johnsmith</p>

                        <div class="bio">
                            <p>Web developer and tech freak who spends his time to chasing new technologies and trends in web & mobile development.</p>

                            <div class="profile-meta m-t-1">
                                <p class="has-text-grey-light">
                                    <span class="icon is-small">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <small>New Delhi</small>
                                </p>
                                <p class="has-text-grey-light">
                                    <span class="icon is-small">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <small>Joined January 2016</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="column is-6">
                    <div class="card">
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

                    <div class="card">
                        <div class="card-content">
                            <p class="has-text-grey-light">
                                <small>&copy; {{ config('app.name') }} 2017</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
