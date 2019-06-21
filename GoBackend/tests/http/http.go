package http

import (
	"bytes"
	"encoding/json"
	"github.com/gin-gonic/gin"
	"io/ioutil"
	"net/http/httptest"
)

// ParseToStr 将map中的键值对输出成querystring形式
func ParseToStr(mp map[string]string) string {
	values := ""
	for key, val := range mp {
		values += "&" + key + "=" + val
	}
	temp := values[1:]
	values = "?" + temp
	return values
}

// Get 根据特定请求uri，发起get请求返回响应
func Get(uri string, router *gin.Engine) []byte {
	req := httptest.NewRequest("GET", uri, nil) // 构造get请求
	w := httptest.NewRecorder() // 初始化响应
	router.ServeHTTP(w, req) // 调用相应的handler接口
	result := w.Result() // 提取响应
	defer result.Body.Close()
	body,_ := ioutil.ReadAll(result.Body) // 读取响应body
	return body
}

// PostForm 根据特定请求uri和参数param，以表单形式传递参数，发起post请求返回响应
func PostForm(uri string, param map[string]string, router *gin.Engine) []byte {
	req := httptest.NewRequest("POST", uri+ParseToStr(param), nil) // 构造post请求，表单数据以querystring的形式加在uri之后
	w := httptest.NewRecorder() // 初始化响应
	router.ServeHTTP(w, req) // 调用相应handler接口
	result := w.Result() // 提取响应
	defer result.Body.Close()
	body, _ := ioutil.ReadAll(result.Body) // 读取响应body
	return body
}

// PostJson 根据特定请求uri和参数param，以Json形式传递参数，发起post请求返回响应
func PostJson(uri string, param map[string]interface{}, router *gin.Engine) []byte {
	jsonByte,_ := json.Marshal(param) // 将参数转化为json比特流
	req := httptest.NewRequest("POST", uri, bytes.NewReader(jsonByte)) // 构造post请求，json数据以请求body的形式传递
	w := httptest.NewRecorder() // 初始化响应
	router.ServeHTTP(w, req) // 调用相应的handler接口
	result := w.Result() // 提取响应
	defer result.Body.Close()
	body,_ := ioutil.ReadAll(result.Body) // 读取响应body
	return body
}
