package models

type Post struct {
	Model

	Name   string
	Text   string
	Type   string
	Pass   string
	Visual bool
}


func MigratePost()  {
	db.DropTableIfExists(&Post{})
	db.CreateTable(&Post{})
}
