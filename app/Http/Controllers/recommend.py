import sys
import MySQLdb

def get_distance(a, b, length):
	distance = 0
	for i in range(length):
		distance += ((a[i] - b[i]) ** 2)

	return distance

try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='gay',db='museum',port=3306)
    
    cur=conn.cursor()

    cur.execute('select max(id) from collections')

    collection_count = int(cur.fetchone()[0])
    
    initial_value = 0
    list_length = collection_count

    user_collections_dict = {}

    user_collection = cur.execute('select * from user_collection')

    #row[1]:user_id  row[2]:collection_id
    for row in cur.fetchall():
        if (int(row[1]) not in user_collections_dict):
            user_collections_dict[int(row[1])] = [initial_value] * list_length

    cur.execute('select * from user_collection')

    for row in cur.fetchall():
    	user_collections_dict[int(row[1])][int(row[2]) - 1] = 1

    #algorithm
    user_user_dict = {}
    	
    for (d1, x1) in user_collections_dict.items():
    	for (d2, x2) in user_collections_dict.items():
    		min_distance = 0

    		distance = get_distance(x1, x2, list_length)
    		if (min_distance == 0 and distance > 0):
    			user_user_dict[d1] = d2
    			min_distance = distance
    		elif (distance < min_distance and distance > 0):
    			user_user_dict[d1] = d2
    			min_distance = distance

    recommend_dict = {}

    for (d1, x1) in user_user_dict.items():
    	for i in range(list_length):
    		if(user_collections_dict[x1][i] == 1 and user_collections_dict[d1][i] == 0):
    			if (d1 in recommend_dict):
    				recommend_dict[d1][i] = 1
    			else:
    				recommend_dict[d1] = [initial_value] * list_length
    		else:
    			if (d1 in recommend_dict):
					recommend_dict[d1][i] = 0
    			else:
					recommend_dict[d1] = [initial_value] * list_length

	cur.execute('delete from user_recommend')
	conn.commit()

   	for (d, x) in recommend_dict.items():
   		for i in range(list_length):
   			if (x[i] == 1):
   				cur.execute('insert into user_recommend (user_id, collection_id) values (%s, %s)'%(d, i+1))
   				conn.commit()

    cur.close()
    conn.close()
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])