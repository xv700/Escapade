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
Where:[{logic:"and",fields:"id",vaule:1234,perator:"Gte" }],
Group:{by:"model"},
}
```

| 字段名 | 可能的值 | 说明 |
| --- | --- | --- |
| Action | "Select" | 执行动作，查询（Select），更新（Update），Delete（删除） | 
| From | "table" | 要操作的表名字 | 
| Fields | "id","make","model" | 显示那些字段 (没想好：匹配所有字段怎么办 ,例如：[" * "]  | 
| Aggregation | [{name:"COUNT",fields:"*",as:"COUNT666"},{name:"SUM",fields:"id",as:"SUM_id"}] | 聚合函数  | 
| TableAs | [{name:"table1",as:"t666"}] | 给表起别名 | 
| FieldsAs | [{name:"make",as:"m888"}] | 给字段起别名 | 
| Limit | "5,10" | 读取条数，从哪个开始到哪里结束 | 
| Sort| [{by:"id",order:"ASC"},{by:"name","order":desc}] | 按照哪个字段排序Asc为正序，Desc为倒序 | 
| Where | [{logic:"and",fields:"id",vaule:1234,perator:"Gte" },{logic:"and",fields:"make",vaule:"aaa",make:"aaa",perator:"Eq" }]  | 过滤条件，相当于where 1=1 and id=1233 |  
| Group | {by:"model"}  | 过滤条件，相当于SELECT * FROM table GROUP BY model; |  
| Having| {FName:"sum",fields:"id",logic:"Gte",vaule:1234}  | 聚合函数的增加预判断，向Fields增加聚合函数，SELECT sum(id) FROM table Having sum(id)>=1234; |  
| ~~Filter~~ | where,include | 过滤条件 |  
| ~~Filter.where~~ | {"logic":"and","id":1234,perator:"eq" } | 字段条件(看下面的操作符) | 
| ~~****Filter.include~~ | {"posts":"authorPointer"} | 关系数据（没想好怎么关联） | 

[where]字段条件操作符(暂定)：
| 操作符 | 说明 |
| --- | --- |
| And | 逻辑与 |
| Or | 逻辑或 |
| Eq/NotEq | 等于/不等于 |
| Gt/Gte | 大于(>),大于或等于(> =)。只有效数值和日期值 |
| Lt/Lte | 小于(<),小于或等于(< =)。只有效数值和日期值 |
| ~~Between~~ | ~~在…之间~~ Gte和Lte可以实现|
| NotNull/Null | {"logic":"and","fields":"name",perator:"Null" } 过滤条件，相当于where name IS NOT NULL |
| Like/NotLike |Where:{Value:"%王_",fields:"name",perator:"NotLike"} 相当于where name not like '%王_',%为任意个字段，_为任意一个字段 |
| In/NotIn | Where:{fields:"name",Value:"'aa','asd'",perator:"In"} 在/不在一个数组之内 |

**DEMO：**
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


