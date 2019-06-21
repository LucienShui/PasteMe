package http

import (
	"github.com/LucienShui/PasteMe/GoBackend/data"
	"github.com/LucienShui/PasteMe/GoBackend/util"
	"github.com/gin-gonic/gin"
)

var router *gin.Engine

func init() {
	router = gin.Default()
	router.GET("", doGet)
	router.POST("", doPost)
}

func Run() {
	if err := router.Run("0.0.0.0:8080"); err != nil {
		panic(err)
	}
}

func doGet(requests *gin.Context) {
	token := requests.DefaultQuery("token", "")
	if token == "" { // empty request
		requests.JSON(501, gin.H{
			"message": "Wrong params",
		})
	} else {
		key, password := util.Parse(token)
		object, err := data.Query(key)
		if err != nil {
			panic(err)
			// TODO
		}
		if object.Password == password { // key and password (if exist) is right
			browser := requests.DefaultQuery("browser", "empty")
			if browser == "empty" { // API request
				requests.JSON(200, gin.H {
					"key":      key,
					"password": password,
					// TODO
				})
			} else { // Browser request
				requests.JSON(200, gin.H {
					"content": 	object.Content,
					"lang": 	object.Lang,
				})
			}
		} else { // key not found or password wrong
			// TODO
		}
	}
}

func doPost(requests *gin.Context) {
	key := requests.DefaultQuery("key", "")
	lang := requests.Query("lang")
	password := requests.DefaultQuery("password", "")
	content := requests.Query("content")
	key, err := data.Insert(key, lang, content, password)
	if err != nil {
		panic(err)
		// TODO
	}
	requests.JSON(200, gin.H {
		"key": key,
	})
}
