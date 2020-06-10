# 暂定名：Escapade
## 任意端发送给服务端查询数据库（0.x.x版本暂定MYSQL）
不限定发送端和接受端的语言，这里只是给出协议规定。  

## 暂定：  
1.X端向服务端发送http协议 json格式，发送body（dataType:"json"）  
2.服务端只输出json格式。  

**设计**:
假设我要操作数据库某个表，向后端发送，

```json
{
Action:"Select",                 
From:"table",                     
Fields:"id,make,model",
Limit:"5,10",
Sort:[{by:"id",order:"ASC"},{by:"make","order":desc}],  
Where:{"logic":"and","id":1234,perator:"eq" },

```

| 字段名 | 可能的值 | 说明 |
| --- | --- | --- |
| Action | "Select" | 执行动作，查询（Select），更新（Update），Delete（删除） | 
| From | "table" | 要操作的表名字 | 
| Fields | ["id","make","model"] | 显示那些字段 (没想好：匹配所有字段怎么办 ,例如：[" * "]  | 
| Limit | "5,10" | 读取条数，从哪个开始到哪里结束 | 
| Sort| [{by:"id",order:"ASC"},{by:"name","order":desc}] | 按照哪个字段排序Asc为正序，Desc为倒序 | 
| Where | {logic:"and",id:1234,perator:"eq" }  | 过滤条件，相当于where 1=1 and id=1233 |  
| Group | {by:"model"}  | 过滤条件，相当于SELECT * FROM table GROUP BY model; |  
| *****Filter | where,include | 过滤条件 |  
| ****Filter.where| {"logic":"and","id":1234,perator:"eq" } | 字段条件(看下面的操作符) | 
| ****Filter.include| {"posts":"authorPointer"} | 关系数据（没想好怎么关联） | 

where字段条件操作符，暂定：
| 操作符 | 说明 |
| --- | --- |
| and | 逻辑与 |
| or | 逻辑或 |
| eq | 等于 |
| gt,gte | 大于(>),大于或等于(> =)。只有效数值和日期值 |
| lt,lte | 小于(<),小于或等于(< =)。只有效数值和日期值 |
| between | 在…之间 |
| ne | 不等于(会被翻译成"<>") |
| NotNull | {"logic":"and","Fields":"name",perator:"Null" } 过滤条件，相当于where name IS NOT NULL |
| Null |  相当于mysql的IS NULL |
| Like,NotLike |Where:{NotLike:"%王%",Fields:"name"} where name not like '%王%' |
| *inq,nin | 在/不在一个数组之内 |



DEMO：
```html
<!DOCTYPE html> 
<html > 
  <head> 
    <meta charset="UTF-8"> 
    <title>anchor</title> 

  </head> 
  <body > 
获取表名字为TableE666的，所有字段的数据
  </body> 
</html> 
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
var data = {
Action:"Select",                 
From:"table",                     
fields:["*"],     
}

$.ajax({  

url:"/restful/test.php",

type:"post",  

dataType:"json",  

data:JSON.stringify(data),  

headers: {'Content-Type': 'application/json'},  

success: function (ret) {    
console.log(ret)

}
})   

</script>
```
假设数据库表名为："table"，结构为：
| id | name |
| --- | --- |
| 1 | 第一组数据 |
| 2 | 第二组数据 |

后端返回:
```JSON
{
   datalist:[
      {
         id:1,
         name:"第一组数据"
      },
      {
         id:2,
         name:"第二组数据"
      }
   ], 
}
```
## 代码实现（后端PHP，数据库Mysql）

- [PHP代码](/PHP)


