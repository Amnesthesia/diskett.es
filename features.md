
USER
---------------
* Registration
* Username
    * Password
    * Mail
* Forgot password
    * Generate new password -> Send to mail -> Force user to set a new password
* Login with Facebook(?)
    * Recommend or Share TVSeries/Episodes

MAIN FEATURES
--------------
  + Notify me when TVShows starts (mail)" (ex. after a break)
  + Export list of air dates to ex. iCal
  + Recommended for me (based on TVSeries the user currently watches/likes)

#### Suggestions:
  + Link to torrent
  + "Delay by 1 day"-option
  + Trends
  + Favorite shows
  + If logged in with Facebook, option to auto-add shows to Facebook's "watched shows"
  + Featured movies?
  + Link to subtitles? (OpenSubtitles.org for example)
  + NotifyMyAndroid-support
  
BEHIND THE SCENES
----------------
* CACHING, CACHING, CACHING:
    * Whenever a user adds a show check if it's cached in the database
    * If not already cached, cache both text and images
* Generate a hopefully unique checksum of images, and check if this checksum already exists in database, before trying to download info from TvDb
