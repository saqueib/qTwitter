// Add me user
export const ADD_ME = (state, user) => {
    state.me = user
}

// Add a tweet details
export const ADD_TWEET_DETAIL = (state, tweet) => {
    state.tweetDetail = tweet;
}

// Open Tweet Details
export const OPEN_TWEET_DETAIL = (state, id) => {
    state.openTweetDetails = id;
}

// Add profilePage
export const PROFILE_PAGE = (state, data) => {
    state.profilePage = data;
}

// Add follow suggestions
export const ADD_FOLLOW_SUGGESTIONS = (state, data) => {
    state.followSuggestions = data;
}


// Increment follow user
export const INCREMENT_FOLLOW_USER_COUNT = (state) => {
    state.me.following_count++;
}

// Decrement follow user
export const DECREMENT_FOLLOW_USER_COUNT = (state) => {
    state.me.following_count--;
}

// Add follow suggestions
export const REMOVE_FROM_FOLLOW_SUGGESTION = (state, user) => {
    let index = state.followSuggestions.indexOf(user);

    setTimeout(function () {
        state.followSuggestions.splice(index, 1);
    }, 1000);
}

// Add Tweets to feed
export const ADD_TWEETS_IN_FEED = (state, tweets) => {
    state.feed = tweets;

}

// Append Tweets to feed
export const APPEND_TWEETS_IN_FEED = (state, tweets) => {
    tweets.forEach((tweet) => {
        state.feed.push(tweet);
    })
}

// Prepend Tweets to feed
export const PREPEND_TWEET_IN_FEED = (state, tweet) => {
    state.feed.unshift(tweet);

    state.me.tweets_count++;
}

// Delete a tweet by id
export const DELETE_TWEET = (state, tweetId) => {
    // find tweet
    let index = state.feed.findIndex( (tweet) => {
        return tweet.id == tweetId
    });

    if( index !== -1 ) {
        state.feed.splice(index, 1);
    }
}

// Toggle loading
export const TOGGLE_LOADING = state => {
    state.isLoading = !state.isLoading
}