package com.unipv.spark.twitter

import twitter4j._
import java.io._
import twitter4j.json.DataObjectFactory

import java.nio.file.{Paths, Files}
import java.nio.charset.StandardCharsets

object Util {
  
  val writer = new PrintWriter(new File("twitter.text" ))
  
  val config = new twitter4j.conf.ConfigurationBuilder()
    .setOAuthConsumerKey("kUregYS2BtPpanZ3hzFCMQ")
    .setOAuthConsumerSecret("dfuF01vrqFm5om2ZPTL89uyieNtiGgZIKdhE8HIyTY")
    .setOAuthAccessToken("989512518-3eznKcRRZWYrhVcObB3l8TWAnLGHtDV5kf1xUVOf")
    .setOAuthAccessTokenSecret("RoJaJyaqOrCve9fmZbJoJWl3OcgWuFsa9Bk3kcNjx6g")
    .setJSONStoreEnabled(true)
    .build
    
  def simpleStatusListener = new StatusListener() {
  def onStatus(status: Status) { 
   
    DataObjectFactory.getRawJSON(status)
    println(status.getText)
    //println("Json" + DataObjectFactory.getRawJSON(status))
    writer.write(DataObjectFactory.getRawJSON(status)+"\n")
    writer.flush()
    
  }
  def onDeletionNotice(statusDeletionNotice: StatusDeletionNotice) {}
  def onTrackLimitationNotice(numberOfLimitedStatuses: Int) {}
  def onException(ex: Exception) { ex.printStackTrace }
  def onScrubGeo(arg0: Long, arg1: Long) {}
  def onStallWarning(warning: StallWarning) {}
}
}