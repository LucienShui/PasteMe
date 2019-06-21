package server

import (
	"github.com/LucienShui/PasteMe/GoBackend/data"
	"github.com/LucienShui/PasteMe/GoBackend/util"
	"github.com/gin-gonic/gin"
	"net/http"
)

var router *gin.Engine

func init() {
	router = gin.Default()
	router.GET("", get)
	router.POST("", post)
}

func Run() {
	if err := router.Run("0.0.0.0:8080"); err != nil {
		panic(err)
	}
}

func get(requests *gin.Context) {
	token := requests.DefaultQuery("token", "")
	if token == "" { // empty request
		requests.JSON(http.StatusForbidden, gin.H{
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
				requests.String(http.StatusOK, object.Content)
			} else { // Browser request
				requests.JSON(http.StatusOK, gin.H {
					"content": 	object.Content,
					"lang": 	object.Lang,
				})
			}
		} else { // key not found or password wrong
			// TODO
		}
	}
}

func post(requests *gin.Context) {
	key := requests.DefaultQuery("key", "")
	lang := requests.Query("lang")
	password := requests.DefaultQuery("password", "")
	content := requests.Query("content")
	key, err := data.Insert(key, lang, content, password)
	if err != nil {
		panic(err)
		// TODO
	}
	requests.JSON(http.StatusOK, gin.H {
		"key": key,
	})
}
