/*
@File: permanent.go
@Contact: lucien@lucien.ink
@Licence: (C)Copyright 2019 Lucien Shui

@Modify Time      @Author    @Version    @Description
------------      -------    --------    -----------
2019-06-18 17:37  Lucien     1.0         Init
*/
package permanent

import (
	"github.com/jinzhu/gorm"
	"time"
)

type Permanent struct {
	Key       uint64 `gorm:"primary_key;index:idx"`
	Lang      string `gorm:"type:varchar(17)"`
	Content   string `gorm:"type:mediumtext"`
	Password  string `gorm:"type:varchar(17)"`
	CreatedAt time.Time
	DeletedAt *time.Time
}

func Insert(db *gorm.DB, lang string, content string, password string) (uint64, error) {
	permanent := &Permanent{
		Content:   content,
		Lang:      lang,
		Password:  password}
	if err := db.Create(&permanent).Error; err != nil {
		return 0, err
	}
	return permanent.Key, nil
}

func Query(db *gorm.DB, key uint64) (Permanent, error) {
	permanent := Permanent{}
	err := db.Find(&permanent, "`key` = ?", key).Error
	return permanent, err
}

func Delete(db *gorm.DB, key uint64) error {
	if err := db.Where("`key` = ?", key).Delete(Permanent{}).Error; err != nil {
		return err
	}
	return nil
}
