/*
@File: request.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-21 08:37  Lucien     1.0         Init
*/
package request

import (
	"bytes"
	"encoding/json"
	"fmt"
	"github.com/LucienShui/PasteMe/GoBackend/data"
	"github.com/gin-gonic/gin"
	"io/ioutil"
	"net/http/httptest"
	"testing"
)

// parseToStr 将map中的键值对输出成querystring形式
func parseToStr(mp map[string]string) string {
	values := ""
	for key, val := range mp {
		values += "&" + key + "=" + val
	}
	temp := values[1:]
	values = "?" + temp
	return values
}

// Get 根据特定请求uri，发起get请求返回响应
func get(t *testing.T, uri string, router *gin.Engine) []byte {
	req := httptest.NewRequest("GET", uri, nil) // 构造get请求
	w := httptest.NewRecorder()                 // 初始化响应
	router.ServeHTTP(w, req)                    // 调用相应的handler接口
	result := w.Result()                        // 提取响应
	body, err := ioutil.ReadAll(result.Body)      // 读取响应body
	if err != nil {
		t.Error(err)
	}
	return body
}

// postForm 根据特定请求uri和参数param，以表单形式传递参数，发起post请求返回响应
func postForm(t *testing.T, uri string, param map[string]string, router *gin.Engine) []byte {
	//t.Fatal(uri + parseToStr(param))
	req := httptest.NewRequest("POST", uri + parseToStr(param), nil) // 构造post请求，表单数据以querystring的形式加在uri之后
	w := httptest.NewRecorder()                                    // 初始化响应
	router.ServeHTTP(w, req)                                       // 调用相应handler接口
	result := w.Result()                                           // 提取响应
	body, err := ioutil.ReadAll(result.Body)                         // 读取响应body
	if err != nil {
		t.Fatal(err)
	}
	return body
}

// postJson 根据特定请求uri和参数param，以Json形式传递参数，发起post请求返回响应
func postJson(t *testing.T, uri string, param map[string]interface{}, router *gin.Engine) []byte {
	jsonByte, err := json.Marshal(param)                                 // 将参数转化为json比特流
	if err != nil {
		t.Fatal(err)
	}
	req := httptest.NewRequest("POST", uri, bytes.NewReader(jsonByte)) // 构造post请求，json数据以请求body的形式传递
	w := httptest.NewRecorder()                                        // 初始化响应
	router.ServeHTTP(w, req)                                           // 调用相应的handler接口
	result := w.Result()                                               // 提取响应
	body, _ := ioutil.ReadAll(result.Body)                             // 读取响应body
	return body
}

func postPaste(t *testing.T, uri string, param data.Paste, router *gin.Engine) []byte {
	jsonByte, err := json.Marshal(param)                                 // 将参数转化为json比特流
	if err != nil {
		t.Fatal(err)
	}
	req := httptest.NewRequest("POST", uri, bytes.NewReader(jsonByte)) // 构造post请求，json数据以请求body的形式传递
	w := httptest.NewRecorder()                                        // 初始化响应
	router.ServeHTTP(w, req)                                           // 调用相应的handler接口
	result := w.Result()                                               // 提取响应
	body, _ := ioutil.ReadAll(result.Body)                             // 读取响应body
	return body
}

func Set(t *testing.T, router *gin.Engine, Key string, Lang string, Content string, Password string) []byte {
	uri := "/"
	params := data.Paste{}
	params.Key = Key
	params.Lang = Lang
	params.Content = Content
	params.Password = Password
	return postPaste(t, uri, params, router)
}

func Get(t *testing.T, router *gin.Engine, Key string, Password string) []byte {
	uri := fmt.Sprintf("/?token=%s,%s&browser=", Key, Password)
	return get(t, uri, router)
}
