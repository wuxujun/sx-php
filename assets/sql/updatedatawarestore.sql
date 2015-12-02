SET NAMES 'utf8';
--$$

CREATE  PROCEDURE `rundim`()
    NO SQL
begin
declare s datetime;
declare e datetime;


-- dim location --
set s = now();

/* dim_location */
insert into D_dim_location
           (country,
            region,
            city)
select distinct country,
                region,
                city
from   woicardb.T_clientdata a
where  not exists (select 1
                   from   D_dim_location b
                   where  a.country = b.country
                          and a.region = b.region
                          and a.city = b.city);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_location',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- devicebrand ----
set s = now();

insert into D_dim_devicebrand(devicebrand_name)
select distinct devicename
from   woicardb.T_clientdata a
where  not exists (select 1
                   from   D_dim_devicebrand b
                   where  a.devicename = b.devicebrand_name);
                   
                   insert into D_dim_deviceos
           (deviceos_name)
select distinct osversion
from   woicardb.T_clientdata a
where  not exists (select *
                   from   D_dim_deviceos b
                   where  b.deviceos_name = a.osversion);
                   
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_deviceos',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- devicelanguage ----
set s = now();

insert into D_dim_devicelanguage
           (devicelanguage_name)
select distinct language
from   woicardb.T_clientdata a
where  not exists (select *
                   from   D_dim_devicelanguage b
                   where  a.language = b.devicelanguage_name);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_devicelanguage',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- resolution ----
set s = now();
insert into D_dim_deviceresolution
           (deviceresolution_name)
select distinct resolution
from   woicardb.T_clientdata a
where  not exists (select *
                   from   D_dim_deviceresolution b
                   where  a.resolution = b.deviceresolution_name);
                   
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_deviceresolution',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- devicesupplier ----
set s = now();
insert into D_dim_devicesupplier
           (devicesupplier_name)
select distinct service_supplier
from   woicardb.T_clientdata a
where  not exists (select *
                   from   D_dim_devicesupplier b
                   where  a.service_supplier = b.devicesupplier_name);

set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_devicesupplier',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- dim_product ----
set s = now();
update 
D_dim_product dp, 
woicardb.T_product p,
       woicardb.T_channel_product cp,
       woicardb.T_channel c,
       woicardb.T_clientdata cd,
       woicardb.T_product_category pc,
       woicardb.T_platform pf
set 
	dp.product_name = p.name,
	dp.product_type = pc.name,
	dp.product_active = p.active,
	dp.channel_name = c.channel_name,
	dp.channel_active = c.active,
	dp.product_key = cd.productkey,
	dp.version_name = cd.version,
        dp.platform = pf.name
where
	p.id = cp.product_id and
	cp.channel_id = c.channel_id and 
	cp.productkey = cd.productkey and 
	p.category = pc.id and 
        c.platform = pf.id and
	dp.product_id = p.id and 
	dp.channel_id = c.channel_id and 
	dp.version_name = cd.version and
	dp.userid = cp.user_id and 
	(dp.product_name <> p.name or 
	dp.product_type <> pc.name or 
	dp.product_active = p.active or 
	dp.channel_name = c.channel_name or 
	dp.channel_active = c.active or 
	dp.product_key = cd.productkey or 
	dp.version_name = cd.version or 
        dp.platform <> pf.name );
insert into D_dim_product
           (product_id,
            product_name,
            product_type,
            product_active,
            channel_id,
            channel_name,
            channel_active,
            product_key,
            version_name,
            version_active,
            userid,
            platform)
select distinct 
p.id,
p.name,
pc.name,
p.active,
c.channel_id,
c.channel_name,
c.active,
cd.productkey,
                cd.version,
                1,
                cp.user_id,
                pf.name
from  woicardb.T_product p inner join
       woicardb.T_channel_product cp on p.id = cp.product_id inner join
       woicardb.T_channel c on cp.channel_id = c.channel_id inner join
       woicardb.T_product_category pc on p.category = pc.id inner join
       woicardb.T_platform pf on c.platform = pf.id inner join (select distinct
       productkey,version from woicardb.T_clientdata) cd on cp.productkey = cd.productkey  
       and not exists (select 1
                       from   D_dim_product dp
                       where  dp.product_id = p.id and
                               dp.channel_id = c.channel_id and
                               dp.version_name = cd.version and
                               dp.userid = cp.user_id);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_product',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- dim_network ----
set s = now();                               
                               
insert into D_dim_network
           (networkname)
select distinct cd.network
from  woicardb.T_clientdata cd
where  not exists (select 1
                       from   D_dim_network nw
                       where  nw.networkname = cd.network);

set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_network',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- activity ----
set s = now();   

insert into D_dim_activity  (activity_name,product_id)
select distinct f.activities,p.id
from   woicardb.T_clientusinglog f,woicardb.T_product p,woicardb.T_channel_product cp
where  
f.appkey = cp.productkey and 
cp.product_id = p.id
and not exists (select 1
                   from   D_dim_activity a
                   where  a.activity_name = f.activities
and a.product_id = p.id);

set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_activity',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- errirtitle ----
set s = now();
insert into D_dim_errortitle
           (title_name,isfix)
select distinct f.title,0
from   woicardb.T_errorlog f
where  not exists (select *
                   from   D_dim_errortitle ee
                   where  ee.title_name = f.title);
                   
-- dim_event
-- update dim_event
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_errortitle',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

-- event ----
set s = now();
update D_dim_event e,woicardb.T_event_defination d
set e.eventidentifier = d.event_identifier,
e.eventname = d.event_name,
e.product_id = d.product_id,
e.active = d.active
where e.event_id = d.event_id and (e.eventidentifier <> d.event_identifier or e.eventname<>d.event_name or e.product_id <> d.product_id or e.active <> d.active);


insert into D_dim_event       (eventidentifier,eventname,active,product_id,createtime,event_id)
select distinct event_identifier,event_name,active,product_id,create_date,f.event_id
from   woicardb.T_event_defination f
where  not exists (select *
                   from   D_dim_event ee
                   where  ee.eventidentifier = f.event_identifier
and ee.eventname = f.event_name
and ee.active = f.active
and ee.product_id = f.product_id
and ee.createtime = f.create_date);

set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('rundim','D_dim_event',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));
end;
--$$

CREATE PROCEDURE `runfact`(IN `starttime` DATETIME, IN `endtime` DATETIME)
    NO SQL
begin
declare s datetime;
declare e datetime;

set s = now();

insert into D_fact_clientdata
           (product_sk,
            deviceos_sk,
            deviceresolution_sk,
            devicelanguage_sk,
            devicebrand_sk,
            devicesupplier_sk,
            location_sk,
            date_sk,
            hour_sk,
            deviceidentifier,
            clientdataid,
			network_sk,
			isnew
			)
select i.product_sk,
       b.deviceos_sk,
       d.deviceresolution_sk,
       e.devicelanguage_sk,
       c.devicebrand_sk,
       f.devicesupplier_sk,
       h.location_sk,
       g.date_sk,
       hour(a.date),
       a.deviceid,
       a.id,
       n.network_sk,
	   case (select count(*) from D_fact_clientdata ff, D_dim_product pp where ff.date_sk < g.date_sk and ff.product_sk = pp.product_sk and pp.product_id = i.product_id and ff.deviceidentifier = a.deviceid) when 1 then 0 else 1 end isnew	  
from   woicardb.T_clientdata a,
       D_dim_deviceos b,
       D_dim_devicebrand c,
       D_dim_deviceresolution d,
       D_dim_devicelanguage e,
       D_dim_devicesupplier f,
       D_dim_date g,
       D_dim_location h,
       D_dim_product i,
       D_dim_network n
where 
       a.osversion = b.deviceos_name
       and a.devicename = c.devicebrand_name
       and a.resolution = d.deviceresolution_name
       and a.language = e.devicelanguage_name
       and a.service_supplier = f.devicesupplier_name
       and date(a.date) = g.datevalue
 	   and a.country = h.country
       and a.region = h.region
       and a.city = h.city
       and a.productkey = i.product_key
       and i.product_active = 1 and i.channel_active = 1 and i.version_active = 1 
       and a.version = i.version_name
       and a.network = n.networkname
	   and a.insertdate between starttime and endtime;

set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runfact','D_fact_clientdata',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
insert into D_fact_usinglog
           (product_sk,
            date_sk,
            activity_sk,
            session_id,
            duration,
            activities,
            starttime,
            endtime,
            uid)
select p.product_sk,
       d.date_sk,
       a.activity_sk,
       u.session_id,
       u.duration,
       u.activities,
       u.start_millis,
       end_millis,
       u.id
from   woicardb.T_clientusinglog u,
       D_dim_date d,
       D_dim_product p,
       D_dim_activity a
where  date(u.start_millis) = d.datevalue and 
       u.appkey = p.product_key
       and u.version = p.version_name 
       and u.activities = a.activity_name
       and u.insertdate between starttime and endtime;
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runfact','D_fact_usinglog',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
insert into D_fact_errorlog
           (date_sk,
            product_sk,
            osversion_sk,
            title_sk,
            deviceidentifier,
            activity,
            time,
            title,
            stacktrace,
            isfix,
            id
            )
select d.date_sk,
       p.product_sk,
       o.deviceos_sk,
       t.title_sk,
       b.devicebrand_sk,
       e.activity,
       e.time,
       e.title,
       e.stacktrace,
       e.isfix,
       e.id
from   woicardb.T_errorlog e,
       D_dim_product p,
       D_dim_date d,
       D_dim_deviceos o,
       D_dim_errortitle t,
       D_dim_devicebrand b
where  e.appkey = p.product_key
       and e.version = p.version_name
       and date(e.time) = d.datevalue
       and e.os_version = o.deviceos_name
       and e.title = t.title_name
       and e.device = b.devicebrand_name
       and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1
       and e.insertdate between starttime and endtime; 
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runfact','D_fact_errorlog',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
insert into D_fact_event
           (event_sk,
            product_sk,
            date_sk,
            deviceid,
            category,
            event,
            label,
            attachment,
            clientdate,
            number)
select e.event_sk,
       p.product_sk,
       d.date_sk,
       f.deviceid,
       f.category,
       f.event,
       f.label,
       f.attachment,
       f.clientdate,
       f.num
from   woicardb.T_eventdata f,
       D_dim_event e,
       D_dim_product p,
       D_dim_date d
where  f.event_id = e.event_id
       and e.product_id = p.product_id
       and f.version = p.version_name
       and f.productkey = p.product_key
       and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1
       and date(f.clientdate) = d.datevalue
       and f.insertdate between starttime and endtime;
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runfact','D_fact_event',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));
set s = now();
end;
--$$

CREATE  PROCEDURE `runmonthly`(IN `begindate` DATE, IN `enddate` DATE)
    NO SQL
begin
declare s datetime;
declare e datetime;

set s = now();

-- update user count
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, usercount)
select 
(select date_sk from D_dim_date where datevalue = begindate) startdate_sk ,
(select date_sk from D_dim_date where datevalue = enddate) enddate_sk, 
p.product_id,'all', count(distinct f.deviceidentifier) count from D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and d.datevalue between begindate and enddate and f.product_sk = p.product_sk and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and f.isnew = 1
group by p.product_id on duplicate key update usercount = values(usercount);

insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,usercount)
select 
(select date_sk from D_dim_date where datevalue=begindate) startdate_sk ,
(select date_sk from D_dim_date where datevalue=enddate) enddate_sk, 
p.product_id, p.version_name,count(distinct f.deviceidentifier) count from D_fact_clientdata f, D_dim_date d, D_dim_product p 
where f.date_sk = d.date_sk and d.datevalue between begindate and enddate and f.product_sk = p.product_sk and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and f.isnew=1
group by p.product_id,p.version_name on duplicate key update usercount=values(usercount);

-- month1
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month1)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -1 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -1 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where
f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate 
and p.product_active=1 and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where
 ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and 
 dd.datevalue between date_add(begindate,interval -1 MONTH) and last_day(date_add(enddate,interval -1 MONTH)) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1)
 group by p.product_id
on duplicate key update month1=values(month1);

-- month2
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month2)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -2 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -2 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where 
 ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between 
 date_add(begindate,interval -2 MONTH) and last_day(date_add(enddate,interval -2 MONTH)) and ff.deviceidentifier = f.deviceidentifier 
 and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id
on duplicate key update month2=values(month2);

-- month3
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month3)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -3 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -3 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p 
where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate 
and enddate and p.product_active=1 and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and 
 dd.datevalue between date_add(begindate,interval -3 MONTH) and last_day(date_add(enddate,interval -3 MONTH)) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1)
 group by p.product_id
on duplicate key update month3=values(month3);

-- month4
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month4)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -4 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -4 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where
f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate 
and p.product_active=1 and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id 
 and dd.datevalue between date_add(begindate,interval -4 MONTH) and last_day(date_add(enddate,interval -4 MONTH)) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) 
 group by p.product_id
on duplicate key update month4=values(month4);

-- month5
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month5)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -5 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -5 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where
 ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue 
 between date_add(begindate,interval -5 MONTH) and last_day(date_add(enddate,interval -5 MONTH)) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 
 and pp.version_active=1 and ff.isnew=1) group by p.product_id
on duplicate key update month5=values(month5);

-- month6
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month6)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -6 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -6 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id 
 and dd.datevalue between date_add(begindate,interval -6 MONTH) and last_day(date_add(enddate,interval -6 MONTH)) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1)
 group by p.product_id
on duplicate key update month6=values(month6);

-- month7
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month7)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -7 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -7 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id 
 and dd.datevalue between date_add(begindate,interval -7 MONTH) and last_day(date_add(enddate,interval -7 MONTH)) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) 
 group by p.product_id
on duplicate key update month7=values(month7);

-- month8
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month8)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -8 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue= last_day(date_add(enddate,interval -8 MONTH))) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where
f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk 
 and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -8 MONTH)
 and last_day(date_add(enddate,interval -8 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 
 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id
on duplicate key update month8=values(month8);

-- month1
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id, version_name,month1)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -1 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -1 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -1 MONTH) and last_day(date_add(enddate,interval -1 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month1 = values(month1);

-- month2
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month2)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -2 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -2 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -2 MONTH) and last_day(date_add(enddate,interval -2 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month2 = values(month2);

-- month3
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month3)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -3 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -3 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -3 MONTH) and last_day(date_add(enddate,interval -3 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month3 = values(month3);

-- month4
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month4)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -4 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -4 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -4 MONTH) and last_day(date_add(enddate,interval -4 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month4 = values(month4);

-- month5
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month5)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -5 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -5 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -5 MONTH) and last_day(date_add(enddate,interval -5 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id
on duplicate key update month5 = values(month5);

-- month6
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month6)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -6 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -6 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -6 MONTH) and last_day(date_add(enddate,interval -6 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month6 = values(month6);

-- month7
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month7)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -7 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -7 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -7 MONTH) and last_day(date_add(enddate,interval -7 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month7 = values(month7);

-- month8
insert into D_fact_reserveusers_monthly (startdate_sk, enddate_sk, product_id,version_name, month8)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -8 MONTH)) startdate,
(select date_sk from D_dim_date where datevalue = last_day(date_add(enddate,interval -8 MONTH))) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -8 MONTH) and last_day(date_add(enddate,interval -8 MONTH)) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1  and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update month8 = values(month8);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runmonthly','D_fact_reserveusers_monthly',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));

end;

--$$
CREATE PROCEDURE `runsum`(IN `today` DATE)
    NO SQL
begin
declare s datetime;
declare e datetime;
-- sum usinglog for each sessions
set s = now();
insert into D_fact_usinglog_daily
           (product_sk,
            date_sk,
            session_id,
            duration)
select  f.product_sk,
         d.date_sk,
         f.session_id,
         sum(f.duration)
from    D_fact_usinglog f,
         D_dim_date d
where   
         d.datevalue = today and f.date_sk = d.date_sk
group by f.product_sk,d.date_sk,f.session_id on duplicate key update duration = values(duration);

set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runsum','D_fact_usinglog_daily',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
-- update segment_sk column

update D_fact_usinglog_daily f,D_dim_segment_usinglog s,D_dim_date d
set    f.segment_sk = s.segment_sk
where  f.duration >= s.startvalue
       and f.duration < s.endvalue
       and f.date_sk = d.date_sk
       and d.datevalue = today;
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runsum','D_fact_usinglog_daily update',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
-- sum_basic_all --
Insert into D_sum_basic_all(product_sk,date_sk,sessions) 
Select f.product_sk, d.date_sk,count(f.deviceidentifier) 
from D_fact_clientdata f, D_dim_date d 
where d.datevalue = today and 
f.date_sk = d.date_sk 
group by f.product_sk,d.date_sk 
on duplicate key update sessions = values(sessions);

Insert into D_sum_basic_all(product_sk,date_sk,startusers) 
Select f.product_sk, d.date_sk,
count(distinct f.deviceidentifier) 
from D_fact_clientdata f, D_dim_date d 
where d.datevalue = today and 
f.date_sk = d.date_sk group by 
f.product_sk,d.date_sk on duplicate key update 
startusers = values(startusers);

Insert into D_sum_basic_all(product_sk,date_sk,newusers) 
Select f.product_sk, d.date_sk,count(distinct f.deviceidentifier) from D_fact_clientdata f, D_dim_date d, D_dim_product p where d.datevalue = today and f.date_sk = d.date_sk and p.product_sk = f.product_sk and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and not exists (select * from D_fact_clientdata ff, D_dim_date dd, D_dim_product pp where ff.date_sk = dd.date_sk and ff.product_sk = pp.product_sk and dd.datevalue < today and pp.product_id = p.product_id and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and f.deviceidentifier = ff.deviceidentifier) group by f.product_sk,d.date_sk  on duplicate key update newusers = values(newusers);


Insert into D_sum_basic_all(product_sk,date_sk,upgradeusers) 
Select p.product_sk, d.date_sk,count(distinct f.deviceidentifier) from D_fact_clientdata f, D_dim_date d, D_dim_product p where d.datevalue = today and f.date_sk = d.date_sk and p.product_sk = f.product_sk  and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists (select 1 from D_fact_clientdata ff, D_dim_date dd, D_dim_product pp where dd.datevalue < today and ff.date_sk = dd.date_sk and pp.product_sk = ff.product_sk and pp.product_id = p.product_id and pp.channel_id = p.channel_id and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and f.deviceidentifier = ff.deviceidentifier and STRCMP( pp.version_name, p.version_name ) < 0) group by p.product_sk,d.date_sk on duplicate key update upgradeusers = values(upgradeusers);



Insert into D_sum_basic_all(product_sk,date_sk,allusers) 
Select f.product_sk, max(f.date_sk), 
count(distinct f.deviceidentifier) from 
D_fact_clientdata f,D_dim_date d where d.date_sk = f.date_sk 
and d.datevalue <= today group by f.product_sk on
duplicate key update allusers = values(allusers);

Insert into D_sum_basic_all(product_sk,date_sk,allsessions) 
Select f.product_sk, max(f.date_sk),count(f.deviceidentifier) 
from D_fact_clientdata f, D_dim_date d where 
d.datevalue <= today and f.date_sk = d.date_sk 
group by f.product_sk on duplicate key update 
allsessions = values(allsessions);

insert into D_sum_basic_all(product_sk,date_sk,usingtime)
select f.product_sk,f.date_sk,sum(duration) from D_fact_usinglog_daily f, D_dim_date d where f.date_sk = d.date_sk and d.datevalue = today group by f.product_sk,f.date_sk on duplicate key update usingtime = values(usingtime);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runsum','D_sum_basic_all',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
-- sum_basic_byhour --
Insert into D_sum_basic_byhour(product_sk,date_sk,hour_sk,
sessions) 
Select f.product_sk, f.date_sk,f.hour_sk,
count(f.deviceidentifier) from D_fact_clientdata f, D_dim_date d
where d.datevalue = today and f.date_sk = d.date_sk
group by f.product_sk,f.date_sk,f.hour_sk on duplicate 
key update sessions = values(sessions);

Insert into D_sum_basic_byhour(product_sk,date_sk,hour_sk,
startusers) 
Select f.product_sk, f.date_sk,f.hour_sk,
count(distinct f.deviceidentifier) from 
D_fact_clientdata f, D_dim_date d where d.datevalue = today  
and f.date_sk = d.date_sk group by f.product_sk,d.date_sk,
f.hour_sk on duplicate key update startusers = values(startusers);

Insert into D_sum_basic_byhour(product_sk,date_sk,hour_sk,newusers) 
Select f.product_sk, f.date_sk,f.hour_sk,count(distinct f.deviceidentifier) from D_fact_clientdata f, D_dim_date d, D_dim_product p where d.datevalue = today and f.date_sk = d.date_sk and p.product_sk = f.product_sk and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and not exists (select 1 from D_fact_clientdata ff, D_dim_date dd, D_dim_product pp where dd.datevalue < today and ff.date_sk = dd.date_sk and pp.product_sk = ff.product_sk and p.product_id = pp.product_id and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and f.deviceidentifier = ff.deviceidentifier) group by f.product_sk,f.date_sk,f.hour_sk on duplicate key update newusers = values(newusers);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runsum','D_sum_basic_byhour',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
-- sum_usinglog_activity --
insert into D_sum_usinglog_activity(date_sk,product_sk,activity_sk,accesscount,totaltime)
select d.date_sk,p.product_sk,a.activity_sk, count(*), sum(duration)
from 		D_fact_usinglog f,         D_dim_product p,   D_dim_date d, D_dim_activity a
where    f.date_sk = d.date_sk and f.activity_sk = a.activity_sk
         and d.datevalue =today
         and f.product_sk = p.product_sk
         and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 
group by d.date_sk,p.product_sk,a.activity_sk
on duplicate key update accesscount = values(accesscount),totaltime = values(totaltime);

insert into D_sum_usinglog_activity(date_sk,product_sk,activity_sk,exitcount)
select tt.date_sk,tt.product_sk, tt.activity_sk,count(*)
from
(select * from(
select   d.date_sk,session_id,p.product_sk,f.activity_sk,endtime
                    from     D_fact_usinglog f,
                             D_dim_product p,
                             D_dim_date d
                    where    f.date_sk = d.date_sk
                             and d.datevalue = today
                             and f.product_sk = p.product_sk
                    order by session_id,
                             endtime desc) t group by t.session_id) tt
group by tt.date_sk,tt.product_sk,tt.activity_sk
order by tt. date_sk,tt.product_sk,tt.activity_sk on duplicate key update
exitcount = values(exitcount);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runsum','D_sum_usinglog_activity',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
insert into D_fact_launch_daily
           (product_sk,
            date_sk,
            segment_sk,
            accesscount) 
select rightf.product_sk,
       rightf.date_sk,
       rightf.segment_sk,
       ifnull(ffff.num,0)
from (select  fff.product_sk,
         fff.date_sk,
         fff.segment_sk,
         count(fff.segment_sk) num
         from (select fs.datevalue,
                 dd.date_sk,
                 fs.product_sk,
                 fs.deviceidentifier,
                 fs.times,
                 ss.segment_sk
                 from (select   d.datevalue,
                           p.product_sk,
                           deviceidentifier,
                           count(* ) times
                           from  D_fact_clientdata f,
                           D_dim_date d,
                           D_dim_product p
                           where d.datevalue = today
                           and f.date_sk = d.date_sk
                           and p.product_sk = f.product_sk
                  group by d.datevalue,p.product_sk,deviceidentifier) fs,
                 D_dim_segment_launch ss,
                 D_dim_date dd
          where  fs.times between ss.startvalue and ss.endvalue
                 and dd.datevalue = fs.datevalue) fff
group by fff.date_sk,fff.segment_sk,fff.product_sk
order by fff.date_sk,
         fff.segment_sk,
         fff.product_sk) ffff right join (select fff.date_sk,fff.product_sk,sss.segment_sk
         from (select distinct d.date_sk,p.product_sk 
         from D_fact_clientdata f,D_dim_date d,D_dim_product p 
         where d.datevalue=today and f.date_sk=d.date_sk and p.product_sk = f.product_sk) fff cross join
         D_dim_segment_launch sss) rightf on ffff.date_sk=rightf.date_sk and
         ffff.product_sk=rightf.product_sk and ffff.segment_sk=rightf.segment_sk
          on duplicate key update accesscount = values(accesscount);
set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runsum','D_fact_launch_daily',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));


set s = now();
end;

--$$

CREATE PROCEDURE `runweekly`(IN `begindate` DATE, IN `enddate` DATE)
    NO SQL
begin
declare s datetime;
declare e datetime;

set s = now();
-- update user count
-- for all version
insert into D_fact_reserveusers_weekly (startdate_sk, enddate_sk, product_id,version_name, usercount)
select 
(select date_sk from D_dim_date where datevalue = begindate) startdate_sk ,
(select date_sk from D_dim_date where datevalue = enddate) enddate_sk, 
p.product_id,'all', count(distinct f.deviceidentifier) count from D_fact_clientdata f, D_dim_date d, 
D_dim_product p where f.date_sk = d.date_sk and d.datevalue between begindate and enddate and f.product_sk = p.product_sk 
and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and f.isnew = 1
group by p.product_id on duplicate key update usercount = values(usercount);

-- for each version

insert into D_fact_reserveusers_weekly (startdate_sk, enddate_sk, product_id, version_name,usercount)
select 
(select date_sk from D_dim_date where datevalue=begindate) startdate_sk ,
(select date_sk from D_dim_date where datevalue=enddate) enddate_sk, 
p.product_id,p.version_name, count(distinct f.deviceidentifier) count from D_fact_clientdata f, D_dim_date d,
D_dim_product p where f.date_sk = d.date_sk and d.datevalue between begindate and enddate 
and f.product_sk = p.product_sk and p.product_active=1 and p.channel_active=1 and p.version_active=1 and f.isnew=1
group by p.product_id,p.version_name on duplicate key update usercount=values(usercount);

-- week1
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week1)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -7 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -7 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -7 DAY) and date_add(enddate,interval -7 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1 ) group by p.product_id
on duplicate key update week1 = values(week1);

-- week2
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name,  week2)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -14 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -14 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -14 DAY) and date_add(enddate,interval -14 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week2 = values(week2);

-- week3
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name,week3)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -21 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -21 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -21 DAY) and date_add(enddate,interval -21 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week3 = values(week3);

-- week4
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week4)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -28 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -28 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -28 DAY) and date_add(enddate,interval -28 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week4 = values(week4);

-- week5
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week5)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -35 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -35 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -35 DAY) and date_add(enddate,interval -35 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week5 = values(week5);

-- week6
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week6)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -42 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -42 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -42 DAY) and date_add(enddate,interval -42 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week6 = values(week6);

-- week7
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week7)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -49 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -49 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -49 DAY) and date_add(enddate,interval -49 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week7 = values(week7);

-- week8
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week8)
Select 
(select date_sk from D_dim_date where datevalue = date_add(begindate,interval -56 DAY)) startdate,
(select date_sk from D_dim_date where datevalue = date_add(enddate,interval -56 DAY)) enddate,
p.product_id,'all',
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active = 1 and p.channel_active = 1 and p.version_active = 1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -56 DAY) and date_add(enddate,interval -56 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active = 1 and pp.channel_active = 1 and pp.version_active = 1 and ff.isnew = 1) group by p.product_id
on duplicate key update week8 = values(week8);

-- By version

-- week1

insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id, version_name,week1)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -7 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -7 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk 
 and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -7 DAY) 
 and date_add(enddate,interval -7 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 
 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id,p.version_name
on duplicate key update week1=values(week1);

-- week2

insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week2)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -14 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -14 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 and p.channel_active=1 
and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk 
 and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -14 DAY)
 and date_add(enddate,interval -14 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 
 and pp.version_active=1 and ff.isnew=1) group by p.product_id,p.version_name
on duplicate key update week2=values(week2);

-- week3

insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id, version_name,week3)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -21 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -21 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk and 
f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 and p.channel_active=1 
and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id 
 and dd.datevalue between date_add(begindate,interval -21 DAY) and date_add(enddate,interval -21 DAY) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) 
 group by p.product_id,p.version_name
on duplicate key update week3=values(week3);

 -- week4
 
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id, version_name,week4)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -28 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -28 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where
f.date_sk = d.date_sk and f.product_sk = p.product_sk and d.datevalue between begindate and enddate 
and p.product_active=1 and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where ff.product_sk = pp.product_sk 
 and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue between date_add(begindate,interval -28 DAY) 
 and date_add(enddate,interval -28 DAY) and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 
 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id,p.version_name
on duplicate key update week4=values(week4);

 -- week5
 
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id, version_name,week5)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -35 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -35 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 and p.channel_active=1 
and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue 
 between date_add(begindate,interval -35 DAY) and date_add(enddate,interval -35 DAY) and ff.deviceidentifier = f.deviceidentifier 
 and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id,p.version_name
on duplicate key update week5=values(week5);

 -- week6
 
insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id, version_name,week6)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -42 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -42 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd where
 ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and 
 dd.datevalue between date_add(begindate,interval -42 DAY) and date_add(enddate,interval -42 DAY) and ff.deviceidentifier = f.deviceidentifier 
 and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id,p.version_name
on duplicate key update week6=values(week6);

-- week7

insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id,version_name, week7)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -49 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -49 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id and dd.datevalue
 between date_add(begindate,interval -49 DAY) and date_add(enddate,interval -49 DAY) and ff.deviceidentifier = f.deviceidentifier 
 and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) group by p.product_id,p.version_name
on duplicate key update week7=values(week7);

-- week8

insert into D_fact_reserveusers_weekly(startdate_sk, enddate_sk, product_id, version_name,week8)
Select 
(select date_sk from D_dim_date where datevalue= date_add(begindate,interval -56 DAY)) startdate,
(select date_sk from D_dim_date where datevalue= date_add(enddate,interval -56 DAY)) enddate,
p.product_id,p.version_name,
count(distinct f.deviceidentifier)
from 
D_fact_clientdata f, D_dim_date d, D_dim_product p where f.date_sk = d.date_sk 
and f.product_sk = p.product_sk and d.datevalue between begindate and enddate and p.product_active=1 
and p.channel_active=1 and p.version_active=1 and exists 
 (select 1 from D_fact_clientdata ff, D_dim_product pp, D_dim_date dd 
 where ff.product_sk = pp.product_sk and ff.date_sk = dd.date_sk and pp.product_id = p.product_id 
 and dd.datevalue between date_add(begindate,interval -56 DAY) and date_add(enddate,interval -56 DAY) 
 and ff.deviceidentifier = f.deviceidentifier and pp.product_active=1 and pp.channel_active=1 and pp.version_active=1 and ff.isnew=1) 
 group by p.product_id,p.version_name
on duplicate key update week8=values(week8);


set e = now();
insert into D_log(op_type,op_name,op_date,affected_rows,duration) 
    values('runweekly','D_fact_reserveusers_weekly',e,row_count(),TIMESTAMPDIFF(SECOND,s,e));
    end;
   
--$$
 
 CREATE  PROCEDURE `rundaily`(IN `yesterday` DATE)
    NO SQL
begin

declare csession varchar(128);
declare clastsession varchar(128);

declare cactivityid int;
declare clastactivityid int;

declare cdatesk int;
declare clastdatesk int;

declare cproductsk int;
declare clastproductsk int;

declare single int;
declare endflag int;
declare seq int;

declare usinglogcursor cursor      

for                                                  

select f.date_sk,product_sk,session_id,activity_sk from D_fact_usinglog f, D_dim_date d where f.date_sk = d.date_sk

and d.datevalue = yesterday;

declare continue handler for not found set endflag = 1;

set endflag = 0;

set clastactivityid = -1;
set single = 0;

open usinglogcursor;

repeat

  fetch usinglogcursor into cdatesk,cproductsk,csession,cactivityid;

  if csession=clastsession then  
      insert into D_sum_accesspath(date_sk,product_sk,fromid,toid,jump,count)

     select cdatesk,cproductsk,clastactivityid,cactivityid,seq,1

     on duplicate key update count=values(count)+1;
    set seq = seq +1;

  else             

insert into D_sum_accesspath(date_sk,product_sk,fromid,toid,jump,count)
              select clastdatesk,clastproductsk,clastactivityid,-999 as cactivityid,seq,1

            on duplicate key update count=values(count)+1;
    


             set seq = 1;

     end if;

   set clastsession = csession;
   set clastactivityid = cactivityid;
   set clastdatesk = cdatesk;
   set clastproductsk = cproductsk;

until endflag=1 end repeat;

close usinglogcursor;
         
insert into D_sum_accesslevel(date_sk,product_sk,fromid,toid,level,count)
select al.date_sk,product_sk,fromid,toid,min(jump),sum(count) from D_sum_accesspath al, D_dim_date d where al.date_sk = d.date_sk and d.datevalue = yesterday group by date_sk,product_sk,fromid,toid
on duplicate key update count = values(count)+1;


end;

