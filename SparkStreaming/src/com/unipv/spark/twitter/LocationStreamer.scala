package com.unipv.spark.twitter

import twitter4j._
import java.io._
import com.unipv.spark.utils.FileUtil

object LocationStreamer {
  def main(args: Array[String]) {
    
    val boundingBoxes = args.map(_.toDouble).grouped(2).toArray
    val twitterStream = new TwitterStreamFactory(Util.config).getInstance
    twitterStream.addListener(Util.simpleStatusListener)
    val tweets = twitterStream.filter(new FilterQuery().locations(boundingBoxes))
    //Thread.sleep(10000)
    //twitterStream.cleanUp
    //twitterStream.shutdown
  }
}