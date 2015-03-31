package com.unipv.spark.streaming

import java.util.Date
import org.apache.spark.streaming.{Seconds, StreamingContext}
import org.apache.spark.SparkContext._
import org.apache.spark.streaming.twitter._
import org.apache.spark.SparkConf

object SaveTweets {
def main(args: Array[String]) {
  val sparkConf = new SparkConf().setMaster("local[1]").setAppName("TwitterPopularTags")
  val ssc = new StreamingContext(sparkConf, Seconds(2))
  
  System.setProperty("twitter4j.oauth.consumerKey", "kUregYS2BtPpanZ3hzFCMQ")
  System.setProperty("twitter4j.oauth.consumerSecret", "dfuF01vrqFm5om2ZPTL89uyieNtiGgZIKdhE8HIyTY")
  System.setProperty("twitter4j.oauth.accessToken", "989512518-3eznKcRRZWYrhVcObB3l8TWAnLGHtDV5kf1xUVOf")
  System.setProperty("twitter4j.oauth.accessTokenSecret", "RoJaJyaqOrCve9fmZbJoJWl3OcgWuFsa9Bk3kcNjx6g")
  
  var z = Array("track=twitter&locations=-122.75,36.8,-121.75,37.8")
//  val outDateFormat = new java.text.SimpleDateFormat("yyyy-MM-dd-HH-mm-ss")
 
  val tweetStream = TwitterUtils.createStream(ssc,None,z)
  
  val hashTags = tweetStream.flatMap(status => status.getText.split(" ").filter(_.startsWith("#")))
  
  val top60 = hashTags.map((_, 1)).reduceByKeyAndWindow(_ + _, Seconds(60))
                     .map{case (topic, count) => (count, topic)}
  top60.foreachRDD(rdd => {
    val topList = rdd.take(10)
    println("\nPopular topics in last 60 seconds (%s total):".format(rdd.count()))
    topList.foreach(println)
  })
  
  
 // tweetStream.foreach(tweet => tweet.saveAsTextFile("../tmp/twitter"+ outDateFormat.format(new Date(java.lang.System.currentTimeMillis()))))
  
  ssc.start()
  ssc.awaitTermination()
  
  }
}

