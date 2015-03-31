package com.unipv.spark.twitter

import twitter4j._

object GatherTweets {
   def main(args: Array[String]) {
    val twitterStream = new TwitterStreamFactory(Util.config).getInstance
    twitterStream.addListener(Util.simpleStatusListener)
    twitterStream.sample
    Thread.sleep(2000)
    twitterStream.cleanUp
    twitterStream.shutdown
  }
}



