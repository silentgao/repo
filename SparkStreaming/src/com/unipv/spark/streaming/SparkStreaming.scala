package com.unipv.spark.streaming
import java.util.Date
import org.apache.spark.streaming.{Seconds, StreamingContext}
import org.apache.spark.SparkContext._
import org.apache.spark.streaming.twitter._
import org.apache.spark.SparkConf
import org.apache.spark.streaming
/**
 * Calculates popular hashtags (topics) over sliding 10 and 60 second windows from a Twitter
 * stream. The stream is instantiated with credentials and optionally filters supplied by the
 * command line arguments.
 *
 * Run this on your local machine as
 *
 */
object SparkStreaming {
def main(args: Array[String]) {
//if (args.length < 4) {
//System.err.println("Usage: TwitterPopularTags <consumer key> <consumer secret> " +
//"<access token> <access token secret> [<filters>]")
//System.exit(1)
    //}

//val Array(consumerKey, consumerSecret, accessToken, accessTokenSecret) = args.take(4)
val filters = Array("track=twitter&locations=-122.75,36.8,-121.75,37.8")

// Set the system properties so that Twitter4j library used by twitter stream
// can use them to generat OAuth credentials
System.setProperty("twitter4j.oauth.consumerKey", "kUregYS2BtPpanZ3hzFCMQ")
System.setProperty("twitter4j.oauth.consumerSecret", "dfuF01vrqFm5om2ZPTL89uyieNtiGgZIKdhE8HIyTY")
System.setProperty("twitter4j.oauth.accessToken", "989512518-3eznKcRRZWYrhVcObB3l8TWAnLGHtDV5kf1xUVOf")
System.setProperty("twitter4j.oauth.accessTokenSecret", "RoJaJyaqOrCve9fmZbJoJWl3OcgWuFsa9Bk3kcNjx6g")


val sparkConf = new SparkConf().setMaster("local[1]").setAppName("TwitterPopularTags")
val ssc = new StreamingContext(sparkConf, Seconds(2))
val stream = TwitterUtils.createStream(ssc, None, filters)

val hashTags = stream.flatMap(status => status.getText.split(" ").filter(_.startsWith("#")))

val topCounts60 = hashTags.map((_, 1)).reduceByKeyAndWindow(_ + _, Seconds(60))
                     .map{case (topic, count) => (count, topic)}
                     .transform(_.sortByKey(false))
val topCounts10 = hashTags.map((_, 1)).reduceByKeyAndWindow(_ + _, Seconds(10))
                     .map{case (topic, count) => (count, topic)}
                     .transform(_.sortByKey(false))
// Print popular hashtags

//val outputDir =  "../tmp/tweets_out";

// Number of output files per batch interval.
//val outputFiles = sys.env.get("OUTPUT_FILES").map(_.toInt).getOrElse(1)
//System.err.println(outputDir + "/" + outputFiles )

//val outputBatchInterval = sys.env.get("OUTPUT_BATCH_INTERVAL").map(_.toInt).getOrElse(60)

//val outDateFormat = outputBatchInterval match {
//      case 60 => new java.text.SimpleDateFormat("yyyy/MM/dd/HH/mm")
//      case 3600 => new java.text.SimpleDateFormat("yyyy/MM/dd/HH")
//    }
                  
//val time = java.lang.System.currentTimeMillis();
                     
//val outPartitionFolder = outDateFormat.format(new Date(time))
    
  //  topCounts60.saveAsTextFiles("%s/%s".format(outputDir, outPartitionFolder), "Count60")            
    topCounts60.foreachRDD(rdd => {
val topList = rdd.take(10)
      println("\nPopular topics in last 60 seconds (%s total):".format(rdd.count()))
      
      topList.foreach{case (count, tag) => println("%s (%s tweets)".format(tag, count))}
    })

    
    //topCounts10.saveAsTextFiles("%s/%s".format(outputDir, outPartitionFolder), "Count10")
    topCounts10.foreachRDD(rdd => {
val topList = rdd.take(10)
      println("\nPopular topics in last 10 seconds (%s total):".format(rdd.count()))
      topList.foreach{case (count, tag) => println("%s (%s tweets)".format(tag, count))}
    })
 
    ssc.start()
    ssc.awaitTermination()
  }
}