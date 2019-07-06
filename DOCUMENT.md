# 使用文档

## 使用指南

### 索引

每一个被上传的文本都有一个字符串去对其进行唯一标识，就像是门牌号一样，我称它为“**索引**”（Paste ID）。纯数字的索引对应永久空间的文本，包含字母的索引对应阅后即焚的文本。

索引的长度至少为三个字符，至多为八个字符。

### 对于别人分享的内容

1. 可直接通过网页链接访问。
2. 可在主页左上角的输入框输入索引进行访问。

### 对于准备上传的内容

#### 永久保存

在主页进行保存。

#### 阅后即焚

1. 在左上角输入含有字母的索引，如果这个索引存在则显示索引内容，不存在则创建一份新的索引。

2. 在主页直接勾选 `阅后即焚`。

所有阅后即焚的内容一旦以任何方式（包括 `API` ）被成功访问就会**永久从数据库中消失**。

关于这部分的逻辑可以看一下伪代码：

```python
if paste_id is not empty:
    show(paste_id)
    delete(paste_id)
else:
    create(paste_id)
```

## API

[API Document](https://github.com/LucienShui/PasteMeBackend/blob/master/API.md)

### Example

```bash
curl api.pasteme.cn/100
curl api.pasteme.cn/101,123456
```