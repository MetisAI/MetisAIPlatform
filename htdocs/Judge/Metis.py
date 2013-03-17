import mysql.connector
import time
import sys
import os
import shutil
import urllib.request

def db_connect():
    user='root'
    pwd='metis'
    host='localhost'
    db='db_ai'
    try:
        database=mysql.connector.connect(user=user,password=pwd,host=host,database=db)
    except mysql.connector.Error as err:
        print("connect database failed.")
        print("Error: {}".format(err.msg))
        sys.exit()
    return database

file_root="b:\\"
com_root="b:\com\\"

def create_directory(a,b):
    if not os.path.exists(str(a)+str(b)):
        os.mkdir(str(a)+str(b))

def compile_code(uid,version,code):
    create_directory(file_root,uid);
    path=file_root+"\\"+str(uid)
    os.chdir(path)
    
    f=open(str(version)+".cpp","w");
    f.write(code);
    f.close();

    os.chdir(com_root)
    f=open(str(version)+".cpp","w");
    f.write(code);
    f.close();
    if os.system("g++ {0}.cpp -o {0} 2> compileinfo".format(str(version)))!=0:
        shutil.copy("compileinfo",path+"\\compileinfo{}.txt".format(version))
        return False
    #compile error
    shutil.copy("{}.exe".format(str(version)),path)
    return True

def change_status(db,pid,status,status_description=""):
    sql="update tProg set status_code='{0}',status='{2}' where PID='{1}'".format(status,pid,status_description)
    print(sql)
    c=db.cursor();
    c.execute(sql)

def query_tProg(db):
    c=db.cursor();
    sql="select PID,code,UID,version from tProg where status_code='0' order by submitted_on asc limit 0,1";
    a=c.execute(sql);
    for row in c.fetchall():
            pid=row[0]
            code=urllib.request.unquote(row[1])
            uid=row[2]
            version=row[3]
            change_status(db,pid,1)
            if compile_code(uid,version,code):
                change_status(db,pid,2,"0%")
                #create_bettle()
            else:
                change_status(db,pid,10)

db=db_connect();
while True:
    query_tProg(db)
    
    time.sleep(5)
