import mysql.connector

DB={"host":"localhost","user":"root","password":"","database":"student_management"}

conn=mysql.connector.connect(**DB)
cur=conn.cursor(dictionary=True)
cur.execute("""
SELECT s.student_code, CONCAT(s.first_name,' ',s.last_name) student,
COUNT(m.id) subjects,
ROUND(AVG((m.marks/m.max_marks)*100),2) average_percentage
FROM students s LEFT JOIN marks m ON m.student_id=s.id
GROUP BY s.id ORDER BY average_percentage DESC
""")
print("\nSTUDENT PERFORMANCE REPORT\n"+"-"*65)
for r in cur.fetchall():
    avg=r["average_percentage"] if r["average_percentage"] is not None else 0
    print(f'{r["student_code"]:10} {r["student"][:25]:25} Subjects: {r["subjects"]}  Avg: {avg}%')
cur.close(); conn.close()
