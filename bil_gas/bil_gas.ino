#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

//deklarasi konstanta
const int smokeA0 = A0;    // sensor LPG
const int led1 = D2;       // led merah
const int led2 = D3;       // led kuning
const int led3 = D4;       // led hijau
const int buzzer = D5;     // buzzer

//KODE IDENTINTAS SENSOR
#define TEMPAT 1001

// Gunakan serial sebagai monitor
#define USE_SERIAL Serial

// Buat object Wifi
ESP8266WiFiMulti WiFiMulti;

// Buat object http
HTTPClient http;

float suhu;
String payload;

String url = "http://192.168.43.89/gas12/add.php?lpg=";

int sensorThres = 400; // 400 adalah skala untuk LPG

void setup() {
  
  // pendefinisian mode pin
  pinMode(led1, OUTPUT);    // merah
  pinMode(led2, OUTPUT);    // kuning
  pinMode(led3, OUTPUT);    // hijau
  pinMode(buzzer, OUTPUT);
  pinMode(smokeA0, INPUT);
  Serial.begin(9600);
  
  //konfigurasi
  USE_SERIAL.setDebugOutput(false);

   for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
    }
 
    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("Ox", "12345679"); // Koneksi dengan wifi , dan sesuaikan dengan nama SSID dan PASSWORD

    digitalWrite(led2,HIGH);
}

void loop() {
  digitalWrite(led3,HIGH); // led hijau menyala
  delay(500);
  digitalWrite(led3,LOW);  // led hijau mati
  
  int analogSensor = analogRead(smokeA0); //membaca sensor dari pin A0 

  // Menampilkan Output Analog Dari A0
  //Serial.println(analogSensor);

  // jika sensor mq2 mendeteksi LPG/GAS maka akan membunyikan Alarm
  if (analogSensor > sensorThres)
    {
      digitalWrite(led1, HIGH); 
      digitalWrite(led2, LOW); 
      digitalWrite(led3, LOW);
     tone(buzzer, 1000, 200);
    }
    else
    {
      digitalWrite(led1, LOW);
      digitalWrite(led2, HIGH); 
      digitalWrite(led3, HIGH);
      noTone(buzzer);
    }
  
  //delay(700);

   // Cek apakah status WIFI sudah terhubung
    if((WiFiMulti.run() == WL_CONNECTED)) {
 
        // Tambahkan data pada URL yang sudah kita buat
        USE_SERIAL.print("[HTTP] Memulai...\n");
        
        http.begin( url + (String) analogSensor + "&tempat=" + TEMPAT ); 
        
        // Mulai koneksi dengan metode GET
        USE_SERIAL.print("[HTTP] Melakukan GET ke server...\n");
        int httpCode = http.GET();
 
        // Periksa httpCode, akan bernilai negatif kalau error
        if(httpCode > 0) {
            
            // Tampilkan response http
            USE_SERIAL.printf("[HTTP] kode response GET: %d\n", httpCode);
 
            // Bila koneksi berhasil, baca data response dari server
            if(httpCode == HTTP_CODE_OK) {
                payload = http.getString();
                USE_SERIAL.println(payload);
            }
 
        } else {
 
            USE_SERIAL.printf("[HTTP] GET gagal, error: %s\n", http.errorToString(httpCode).c_str());
        }
 
        http.end();
    }
 
    delay(500);
}
