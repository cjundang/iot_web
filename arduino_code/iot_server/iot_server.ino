/////////////////////////////////
// Generated with a lot of love//
// with TUNIOT FOR ESP8266     //
// Website: Easycoding.tn      //
/////////////////////////////////
#include <ESP8266WiFi.h>

#include "DHT.h"

WiFiServer server(80);

DHT dht4(4,DHT11);

void setup()
{
  Serial.begin(9600);
  dht4.begin();
  WiFi.disconnect();
  delay(3000);
   WiFi.begin("3BB_1317-2.4g","600600107");
  while ((!(WiFi.status() == WL_CONNECTED))){
    Serial.print(".");
    delay(300);

  }
  Serial.println("Connected");
  Serial.print("IP Address: ");
  Serial.println((WiFi.localIP().toString()));
  server.begin();
  

}


void loop()
{

    WiFiClient client = server.available();
    if (!client) { return; }
    while(!client.available()){  delay(1); }
    Serial.print("Request from ");
    Serial.println((client.remoteIP()));
    client.println("HTTP/1.1 200 OK");
    client.println("Content-Type: text/html");
    client.println("");
    client.println((dht4.readTemperature( )));


    delay(1);

}
