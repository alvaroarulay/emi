USE LOCFILE("C:\vsiaf\dbfs\bajas.dbf") ALIAS act
					GO top
					DO WHILE NOT EOF()
						TRY
							SCATTER MEMO memvar
							SELECT "C:\Users\bcuevas\Desktop\56320\bajascorrectosolo\BAJAS.dbf"
							INSERT INTO BAJAS FROM memvar
						CATCH
							SCATTER memvar
							SELECT "C:\Users\bcuevas\Desktop\56320\bajascorrectosolo\BAJAS.dbf"
							INSERT INTO BAJAS FROM memvar
						ENDTRY
						
						SELECT bajas 
						skip
					ENDDO