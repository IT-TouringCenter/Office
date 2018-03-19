/*DROP function is exists*/
DROP FUNCTION if exists nst_fn_generateIdentifies;

DELIMITER $$
CREATE FUNCTION nst_fn_generateIdentifies()
RETURNS VARCHAR(10)
BEGIN
	DECLARE totalId INT;
    DECLARE lastId INT;
    
	DECLARE id varchar(4);
    DECLARE your_key varchar(10);
	DECLARE ym varchar(6);
	
	DECLARE y varchar(4);
	DECLARE m varchar(2);
	
	SET y = DATE_FORMAT(CURDATE(),'%Y');
	SET m = DATE_FORMAT(CURDATE(),'%m');

	SET totalId = 0;
	SET lastId = 0;

	SELECT count(*) into totalId FROM reserve_identifies;

	if totalId = 0 then
		SET lastId=1;
	else 
		SET lastId= totalId+1;
	end if;
	
	SET id = LPAD(lastId,4,'0');
    	
	SET ym = concat(y,m);
	SET your_key = concat(ym,id);
		
	RETURN your_key;
END $$

DELIMETER ;