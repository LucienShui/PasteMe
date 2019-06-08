/*
@File    :   api.js
@Contact :   lucien@lucien.ink
@License :   (C)Copyright 2019, Lucien Shui

@Modify Time      @Author    @Version    @Desciption
------------      -------    --------    -----------
2019-06-07 01:14  Lucien     1.0         None
*/
import axios from 'axios'
import qs from 'qs'

export default {
    get: function(url, params = {}) {
        return new Promise((resolve, reject) => {
            axios.get(url, {
                params: params
            }).then(response => {
                resolve(response.data);
            }).catch(error => {
                alert(url + '\n' + JSON.stringify(error));
                reject(error);
            });
        });
    },
    post: function(url, params = {}) {
        return new Promise((resolve, reject) => {
            axios.post(url, qs.stringify(params)).then(response => {
                resolve(response.data);
            }).catch(error => {
                alert(url + '\n' + JSON.stringify(error));
                reject(error);
            });
        });
    }
}
