/*
@File: server.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-21 08:37  Lucien     1.0         Init
*/
package server

import (
	"fmt"
	"github.com/LucienShui/PasteMe/GoBackend/data"
	"github.com/LucienShui/PasteMe/GoBackend/util"
	"github.com/gin-gonic/gin"
	"net/http"
)

var router *gin.Engine

func init() {
	router = gin.Default()
	router.Use(cors)
	router.GET("/", get)
	router.POST("/", post)
}

func Run(address string, port uint16) {
	if err := router.Run(fmt.Sprintf("%s:%d", address, port)); err != nil {
		panic(err)
	}
}

func cors(c *gin.Context) {
	method := c.Request.Method

	c.Header("Access-Control-Allow-Origin", "*")
	c.Header("Access-Control-Allow-Headers", "Content-Type,AccessToken,X-CSRF-Token, Authorization, Token")
	c.Header("Access-Control-Allow-Methods", "POST, GET, OPTIONS")
	c.Header("Access-Control-Expose-Headers", "Content-Length, Access-Control-Allow-Origin, Access-Control-Allow-Headers, Content-Type")
	c.Header("Access-Control-Allow-Credentials", "true")

	if method == "OPTIONS" {
		c.AbortWithStatus(http.StatusNoContent)
	}

	c.Next()
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
	paste := data.Paste{}
	if err := requests.Bind(&paste); err != nil {
		panic(err)
		// TODO
	}
	key, err := data.Insert(paste)
	if err != nil {
		panic(err)
		// TODO
	}
	requests.JSON(http.StatusOK, gin.H {
		"key": key,
	})
}
