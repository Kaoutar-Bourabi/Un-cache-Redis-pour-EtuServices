# -*- coding: utf-8 -*-
"""
Created on Wed Jan 18 13:31:02 2023

@author: PC
"""

# 

import redis
import sys


r = redis.Redis('localhost', 6379, charset="utf-8", decode_responses=True)
utilisateur = sys.argv[1]



def setSession(utilisateur):
    r.set(f"{utilisateur}_count", 1)
    r.set(f"{utilisateur}_time", "valide")
    r.expire(f"{utilisateur}_time", 600)
    r.set(utilisateur, 1)

def getUserSession(utilisateur):
    return {"timeout" : r.get(f"{utilisateur}-time"), "count" : r.get(f"{utilisateur}-count")}

def incrementUserSession(utilisateur):
    r.incr(f"{utilisateur}-count")

userSession = getUserSession(utilisateur)
sessionTimeout = userSession["timeout"]
sessionCount = int(userSession["count"])

if sessionTimeout == None:
       setSession(utilisateur)
       print(1)
else:
    if sessionCount < 10:
        incrementUserSession(utilisateur)
        print(sessionCount + 1)
    else:
        print(f"Vous avez atteint le nombre maximal de connexion autorisées, réessayez dans {r.ttl(utilisateur+'-time') // 60} minutes")
        
sys.exit(8)