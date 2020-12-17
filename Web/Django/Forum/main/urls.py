from django.urls import path
from django.conf.urls import url
from . import views
# from django.contrib.auth.views import LoginView#,LogoutView

urlpatterns = [
	path('', views.indexView, name="home"),
	path('readpost/<int:pid>/', views.readpostView, name="read_post"),
	path('comment/<int:pid>/<int:uid>/', views.replyRequest),
	path('signup/', views.registerView, name="register_url"),
	path('signin/', views.loginView, name="login_url"),
	path('logout/', views.logoutRequest, name="logout_url"),
	path('superuser/', views.adminView, name="admin_url"),

	path('post/<int:pid>/', views.postRequest),
	path('deluserrequest/<int:uid>/', views.delUserRequest),
	path('delpostrequest/<int:pid1>/<int:pid2>/', views.delPostRequest)
	# path('dashboard/', views.dashboardView, name="dashboard"),
]