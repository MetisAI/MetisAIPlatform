import mysql.connector
import time
import sys
import os

def db_connect():
    user='root'
    pwd='000000'
    host='localhost'
    db='db_ai'
    try:
        database=mysql.connector.connect(user=user,password=pwd,host=host,database=db)
    except mysql.connector.Error as err:
        print("connect database failed.")
        print("Error: {}".format(err.msg))
        sys.exit()
    return database

com_root="b:\\"
def compile_code(uid,version,code):
    os.chdir(com_root+uid+"\\");
    return True;

def change_status(db,pid,status,status_description=""):
    sql="update tProg set status_code='{0}',status='{2}' where PID='{1}'".format(status,pid,status_description)
    c=db.cursor();
    c.execute(sql)

def query_tProg(db):
    c=db.cursor();
    sql="select PID,code,UID,version from tProg where status_code='0' order by submitted_on asc limit 0,1";
    a=c.execute(sql);
    for row in c.fetchall():
            pid=row[0]
            code=row[1]
            uid=row[2]
            version=row[3]
            change_status(db,pid,1)
            if compile_code(uid,version,code):
                change_status(db,pid,2,"0%")
                #create_bettle()
            else:
                pass

db=db_connect();
while True:
    query_tProg(db)
    
    time.sleep(5)
