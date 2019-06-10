package main

import (
	"github.com/gin-gonic/gin"
	"github.com/lucienshui/pasteme/data"
	"strings"
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
			token := strings.Split(token, ",")
			key := token[0]
			var password string
			if len(token) == 2 {
				password = token[1]
			}
			flag := data.Get(key, password)
			// TODO
			if flag { // key and password (if exist) is right
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

	})

	err := server.Run(":8080")
	if err != nil {

	}
}
