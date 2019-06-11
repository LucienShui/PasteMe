package main

import (
	"github.com/gin-gonic/gin"
	"github.com/lucienshui/pasteme/data"
	"github.com/lucienshui/pasteme/util"
)

func main() {
	server := gin.Default()
	server.GET("", func(requests *gin.Context) {
		token := requests.DefaultQuery("token", "")
		if token == "" { // empty request
			requests.JSON(501, gin.H {
				"message": "Wrong params",
			})
		} else {
			key, password := util.Parse(token)
			object := data.Get(key, password)
			// TODO
			if object { // key and password (if exist) is right
				browser := requests.DefaultQuery("browser", "")
				if browser == "" { // API request
					requests.JSON(200, gin.H {
						"key": key,
						"password": password,
						// TODO
					})
				} else { // Browser request
					requests.JSON(200, gin.H {
						// TODO
					})
				}
			} else { // key not found or password wrong
				// TODO
			}
		}
	})

	server.POST("", func(requests *gin.Context) {
		// TODO
	})

	err := server.Run(":8080")
	if err != nil {
		// TODO
	}
}
