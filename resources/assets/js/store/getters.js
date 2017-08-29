// get authenticated user
export const me = state => state.me

// get user feed
export const feed = state => state.feed

// Get user profile page
export const profilePage = state => state.profilePage

// get tweet detail
export const tweetDetail = state => state.tweetDetail

// get suggest follower count
export const followerSuggestions = state => state.followSuggestions

// open tweet details
export const openTweetDetails = state => state.openTweetDetails

// Get toggle status of loading
export const isLoading = state => state.isLoading

// Get the app name
export const appName = state => state.appName