<template>
    <div class="card-content bg-light">
        <div class="media">
            <div class="media-left">
                <figure class="image is-32x32 is-circle">
                    <img :src="user.avatar" alt="Image">
                </figure>
            </div>
            <div class="media-content">
                <form action="">
                    <div class="field">
                        <div class="control">
                            <textarea :maxlength="maxLength" rows="3" v-model="body" class="textarea" :placeholder="placeholder"></textarea>
                        </div>
                        <p v-if="errorMsg" class="help-block help is-danger">{{ errorMsg }}</p>
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
                            <div class="level-item has-text-grey">{{ maxLength - body.length }}</div>
                            <div class="level-item">
                                <button @click.prevent="submit" class="button is-outlined is-primary" :class="{'is-loading': loading }">
                                    {{ btnText }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--tweet box end-->
    </div>
</template>

<script>
    export default {
        name: 'TweetBox',
        props: {
            user: Object,
            maxLength: {default: 200, type: Number},
            isReply: false,
            btnText: {default: 'Tweet'},
            placeholder: {default: 'Whats happening?'},
        },
        computed: {
            tweetId() {
                return this.$store.getters.tweetDetail.id;
            },
        },
        data() {
            return {
                body: '',
                errorMsg: '',
                loading: false
            }
        },
        created() {
          console.log('TweetBox Component created.')
        },
        methods: {
            displayError(res) {
                if(res.errors) {
                    this.errorMsg = res.errors[0].validation.body[0];
                } else {
                    this.body = this.errorMsg = '';
                }
            },
            submit() {
                this.loading = true

                if(this.isReply) {
                    this.$store.dispatch('postReply', { body: this.body, id: this.tweetId}).then((res) => {
                        this.loading = false;
                        this.displayError(res)
                    })
                } else {
                    this.$store.dispatch('postTweet', this.body).then((res) => {
                        this.loading = false;
                        this.displayError(res)
                    })
                }
            }
        }
    }
</script>